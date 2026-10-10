# Architecture and workflows

## Overview

ChasiConnect is a traditional multi-page PHP application. Each browser request executes a PHP entry-point script, reads or mutates MySQL through `mysqli`, and returns server-rendered HTML. There is no application framework, package manager, build step, routing layer, or background worker.

```text
Browser
  │
  ├─ public/page entry point (login.php, farmer/*.php, ...)
  │    ├─ Auth role check
  │    ├─ Controller orchestration or page-local request handling
  │    ├─ Model / prepared mysqli query
  │    └─ View template
  │
  └─ ajax/search-projects.php ─ ProjectController ─ partial HTML response

PHP process ─ core/Database.php ─ MySQL/MariaDB
```

## Components

### Entry points

Top-level and role directories contain the URLs visited by the browser. Some newer pages delegate most behavior to a controller and view; some older pages still contain request handling, SQL, and presentation in the same file.

### Core services

- `core/Database.php` exposes one `mysqli` connection per request and reads `DB_*` process environment variables.
- `core/Auth.php` starts sessions, records the logged-in user, and enforces one or more roles.
- `core/Cookie.php` wraps cookie access for remembered investor project searches.
- `db.php` is a compatibility adapter for older pages that expect a global `$conn` variable.

### Controllers

- `AuthController` handles login, registration, role-profile creation, and dashboard redirection.
- `AdminController` handles moderation, user status, reports, dashboard metrics, and shareouts.
- `FarmerController` handles farmer dashboards, projects, progress updates, and harvest lists.
- `InvestorController` supplies portfolio and project-detail data.
- `LandownerController` handles land records and verified-farmer search.
- `ProjectController` supplies investor project browsing and AJAX search results.

### Models

Models group SQL operations by domain: users, farmers, investors, landowners, projects, investments, and administration. Most write operations use prepared statements. A few legacy entry points still execute their own prepared queries directly.

### Views and styling

Views are PHP/HTML templates. Tailwind CSS is loaded from the browser CDN on most pages, while `style.css` contains shared custom CSS. Google Fonts and Material Symbols are remote runtime dependencies.

## Role boundaries

| Role | Main responsibilities |
| --- | --- |
| Administrator | Verify farmers, approve/reject projects, manage users and reports, inspect/finalize shareouts |
| Farmer | Accept/reject hiring requests, create projects, post progress, complete projects, log harvests |
| Investor | Browse/search approved projects, invest, review portfolio and distributed returns |
| Landowner | List/manage land, search verified farmers, create and monitor hiring/lease requests |

Role checks are performed with `Auth::requireRole()` in controller-oriented pages or explicit session checks in legacy pages.

## Core lifecycle

### Land and hiring

1. A landowner creates an available land record and may upload an image.
2. The landowner selects an approved farmer and sends a request tied to a land parcel and lease amount.
3. The farmer accepts or rejects it. Acceptance makes the land unavailable.

### Project approval and funding

1. A farmer selects accepted land and submits a pending farming project.
2. The required budget is farming cost plus the accepted lease amount.
3. An administrator changes the pending project to approved or rejected.
4. Investors may fund approved or active projects up to the remaining budget.
5. An investment locks the project row, inserts a confirmed investment, and updates funding in one transaction.

### Completion, harvest, and shareout

1. A farmer can complete a project in the active state, setting progress to 100%.
2. Harvest records provide revenue through `estimated_value`.
3. `_profit-distribution-helper.php` locks the completed project and confirmed investments.
4. Profit is `sum(harvest estimated value) - required budget` and must be positive.
5. The helper allocates profit, reconciles rounding to the largest investor, saves shares, and marks the project settled.
6. The caller commits or rolls back the surrounding transaction.

The shareout is designed to be idempotent at the database level: `profit_distributed_at` prevents a second settlement.

## Architectural constraints

- PHP session state is required; horizontal scaling needs shared session storage or sticky sessions.
- Uploaded images are stored on the local filesystem; multi-instance deployment needs shared/object storage.
- There is no schema migration system; `chasiConnect.sql` is a destructive development bootstrap.
- There is no automated test suite or continuous-integration configuration.
- CDN-hosted CSS, fonts, and icons require outbound browser connectivity.
- Some workflows mix controllers/models with page-local SQL and should be standardized before major expansion.
