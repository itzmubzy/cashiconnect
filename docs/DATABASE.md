# Database model

## Bootstrap warning

`chasiConnect.sql` is a complete development reset: it creates/selects the `cc` database, disables foreign-key checks, drops the project tables, recreates them, and inserts demo data. Do not run it against a production or shared database.

## Tables

| Table | Purpose | Important relationships |
| --- | --- | --- |
| `users` | Identity, role, and account status | Parent of all role profiles and reports |
| `farmer_profiles` | Farmer details, verification, and rating | One-to-one with `users` |
| `investor_profiles` | Investor details and preferences | One-to-one with `users` |
| `landowner_profiles` | Landowner details | One-to-one with `users` |
| `lands` | Land parcels and availability | Belongs to a landowner |
| `hiring_requests` | Farmer/landowner request, lease, and response | Connects landowner, farmer, and land |
| `farming_projects` | Crop project, budget, funding, state, and settlement | Belongs to a farmer and land |
| `project_updates` | Milestones, progress, expense, and date | Belongs to a project |
| `investments` | Confirmed/pending capital and investor profit share | Connects investor and project |
| `harvests` | Quantity, date, and estimated revenue | Belongs to a project |
| `reports` | User/project moderation reports | References reporter, optional user, and optional project |

Foreign keys use cascading deletes for most owned records. Reports preserve history with `SET NULL` when an optional reported user or project is removed.

## State models

### Project

```text
pending ── approve ──> approved ── funding/work ──> active ── complete ──> completed
   └────── reject ──> rejected
```

The current implementation also marks a project `completed` when its funding reaches the required budget. Review this behavior before production use because other pages expect an `active` state for manual completion.

### Hiring request

```text
pending ──> accepted ──> completed
   └──────> rejected
```

### Farmer verification

```text
pending ──> approved
   └──────> rejected
```

### Account

```text
active <──> suspended
```

## Profit distribution

For a completed project with at least one harvest and confirmed investment:

```text
revenue = SUM(harvests.estimated_value)
profit  = revenue - farming_projects.required_budget

investor pool = profit × 60.0%
farmer share  = profit × 39.5%
platform share = profit × 0.5%
```

Each investor receives:

```text
investor profit share =
  investor confirmed amount / total confirmed amount × investor pool
```

Money values are rounded to two decimal places. Any investor-pool rounding remainder is applied to the largest investment, and settlement aborts if the final reconciliation differs from profit by at least 0.01.

The helper must run inside a transaction. It locks the project and investments with `FOR UPDATE`, writes every investment's `profit_share`, and sets the project's settlement timestamp and aggregate shares.

## Backups and migrations

The project has no migration tooling. Before changing schema:

1. Create a versioned migration script instead of editing a live database manually.
2. Back up the target database.
3. Test forward and rollback paths on a disposable copy.
4. Update this document, `chasiConnect.sql`, and affected queries together.

Example development backup:

```bash
mysqldump -u root -p --single-transaction cc > cc-backup.sql
```

Keep backups outside the repository, especially when they contain user data.
