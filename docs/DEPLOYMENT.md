# Deployment guide

## Status

ChasiConnect is suitable for local demonstrations and controlled development environments. Complete the production-readiness work in `SECURITY.md` before deploying it publicly or accepting real data or money.

## Runtime requirements

- PHP 8.0+ with `mysqli`, `mbstring`, sessions, and file-upload support.
- MySQL 8.0+ or compatible MariaDB.
- Apache with PHP, or Nginx/Apache connected to PHP-FPM.
- A writable `uploads/lands/` directory.
- HTTPS for any environment beyond local development.

## Configuration

Set the following in the PHP process environment rather than committing credentials:

```text
DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD
DB_CHARSET
```

Grant the application database user only the operations required on the ChasiConnect schema. Do not use a MySQL administrative account in production.

## Apache outline

1. Point a virtual host's document root at the repository root.
2. Enable PHP and ensure `DirectoryIndex` includes `home.php` or route `/` explicitly.
3. Pass the `DB_*` variables through a protected server configuration.
4. Allow PHP write access only to `uploads/lands/` and the configured session directory.
5. Disable directory listing and script execution inside uploaded-content directories.
6. Set conservative PHP upload size and execution limits.
7. Configure TLS and redirect HTTP to HTTPS.

## Nginx/PHP-FPM outline

1. Set the site root to the repository root.
2. Route only existing `.php` files to PHP-FPM and use `home.php` as an index or explicit landing page.
3. Define `DB_*` values in a protected PHP-FPM pool/environment configuration.
4. Deny access to dotfiles, local backups, documentation-only environment files, and database exports if they remain below the web root.
5. Serve uploads as static files with PHP execution disabled.
6. Configure TLS, security headers, request limits, and access/error logs.

## Database initialization

Do not use the destructive seeded SQL file as a production deployment mechanism. Create an empty production schema through reviewed migrations, create the first administrator through a protected bootstrap process, and remove demo account creation from the login path.

## Persistent state

Back up and persist:

- The MySQL database.
- Runtime uploads from `uploads/lands/`.
- Any shared PHP session store if sessions must survive instance replacement.

Do not store logs, secrets, or backups in the Git repository.

## Post-deployment checks

1. Confirm the application can connect using the least-privileged DB account.
2. Confirm unprivileged users cannot enter another role's pages.
3. Confirm uploads accept only validated image content and cannot execute.
4. Exercise the land, hiring, approval, investment, completion, harvest, and settlement workflow with test data.
5. Verify duplicate investment and settlement requests cannot double-write.
6. Verify error pages and logs do not expose SQL, credentials, filesystem paths, or personal information.
7. Confirm backups can be restored in a separate environment.
