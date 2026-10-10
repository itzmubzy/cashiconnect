# Contributing to ChasiConnect

Thank you for improving ChasiConnect. The project is currently a PHP/MySQL prototype, so changes should prioritize clarity, data safety, and incremental modernization.

## Development setup

1. Install PHP 8.0+ with `mysqli` and `mbstring`.
2. Install MySQL 8.0+ or a compatible MariaDB release.
3. Import `chasiConnect.sql` into a disposable development database.
4. Configure the `DB_*` process environment variables described in `README.md`.
5. Start a local server with `php -S 127.0.0.1:8000` and open `home.php`.

The SQL seed is destructive and must not be imported over a database containing valuable data.

## Branches and commits

- Create a focused branch from the default branch.
- Keep commits small and explain the reason for each change.
- Do not commit `.env` files, database credentials, runtime uploads, logs, database exports containing user data, or editor metadata.
- Update documentation whenever a workflow, configuration variable, schema, or prerequisite changes.

## Required checks

Run PHP syntax lint on every PHP file:

```powershell
Get-ChildItem -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }
```

Manually exercise the affected role workflow with a disposable database. For changes to investments or shareouts, verify transaction rollback, duplicate-submit behavior, budget boundaries, and rounding reconciliation.

## Pull requests

Include:

- A concise summary and motivation.
- The pages, roles, and tables affected.
- Manual verification steps and results.
- Screenshots for visible UI changes.
- Schema migration and rollback notes for database changes.
- Any security implications, especially for authentication, authorization, uploads, or financial calculations.

Do not use real personal information or financial data in tests, screenshots, or seed records.
