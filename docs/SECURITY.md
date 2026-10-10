# Security and production readiness

## Current classification

ChasiConnect is a demonstration prototype. Do not expose it publicly, use real identities, or process real investments until the issues below are addressed and the result receives a dedicated security review.

## Known high-priority limitations

- Passwords are stored and compared as plain text. Replace this with `password_hash()` and `password_verify()`, then migrate all accounts.
- The login controller creates predictable demo accounts automatically, and the SQL seed contains predictable passwords. Remove both behaviors outside isolated development.
- State-changing forms do not have CSRF tokens.
- Authentication throttling, lockout, password reset, email verification, and multi-factor authentication are absent.
- Several legacy pages perform authorization and SQL locally instead of through one consistent policy layer.
- File upload validation is extension-based. Validate MIME/content, enforce size and dimensions, store outside the executable web root or in object storage, and block script execution.
- Session cookie attributes and centralized security headers are not explicitly configured.
- Some database or workflow errors are shown directly to users.
- Tailwind, fonts, and icons load from third-party CDNs without a defined Content Security Policy or pinned self-hosted assets.
- There is no automated security, unit, integration, or end-to-end test suite.
- Financial values use decimal database columns but PHP floating-point arithmetic. Review and test monetary rounding rules or use integer minor units/a decimal library.

## Before any public deployment

1. Implement secure password hashing and remove demo account provisioning.
2. Add CSRF protection and consistent server-side authorization for every mutation.
3. Harden sessions with HTTPS-only, `HttpOnly`, appropriate `SameSite`, rotation, idle expiry, and logout invalidation.
4. Centralize validation and return generic user-facing errors while logging safely.
5. Harden uploads and serve them from a non-executable, isolated location.
6. Add schema migrations, database backups, audit logging, and tested restore procedures.
7. Add automated tests for role boundaries, concurrency, duplicate submissions, and settlement invariants.
8. Add dependency/static analysis, secret scanning, and CI checks.
9. Conduct threat modeling and an independent application-security review.
10. Review privacy, financial, consumer-protection, and data-residency obligations for the target jurisdiction.

## Secrets

Database configuration is read from process environment variables. `.env` files are ignored by Git, but the application does not parse them automatically. Never commit access tokens, private keys, real database exports, production logs, or credentials.

If a secret is committed, removing the file in a later commit is insufficient. Revoke or rotate the secret immediately and then clean repository history through a coordinated process.

## Reporting vulnerabilities

Until a private security contact is published, do not open a public issue containing exploit details, credentials, or personal data. Contact the repository owner privately and include affected versions, reproduction steps, impact, and a proposed mitigation when possible.
