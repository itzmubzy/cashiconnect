# ChasiConnect

ChasiConnect is a server-rendered agricultural collaboration and investment prototype for connecting farmers, landowners, and investors under an administrator-managed workflow. It supports land leasing, farmer verification, farming-project approval and funding, progress and harvest tracking, and transactional profit distribution.

**Static showcase:** [itzmubzy.github.io/cashiconnect](https://itzmubzy.github.io/cashiconnect/) — a database-free, interactive presentation of the product and its workflows.

> [!WARNING]
> This repository is a development/academic prototype, not a production-ready financial platform. It includes predictable demo credentials and currently stores passwords as plain text. Read [Security and production readiness](docs/SECURITY.md) before exposing it to a network or using real personal or financial data.

## Features

- Role-based registration, login, sessions, and dashboards for administrators, farmers, investors, and landowners.
- Land listing management with optional JPG, JPEG, PNG, or WebP uploads.
- Verified-farmer discovery and landowner-to-farmer hiring requests with lease amounts.
- Farming-project creation from accepted land arrangements and administrator approval.
- Investor project search, project details, funding progress, and transaction-safe investments.
- Farmer progress updates, harvest records, project completion, and earnings visibility.
- Profit settlement with row locking and transaction handling:
  - 60% of profit goes to investors, allocated proportionally to confirmed investment.
  - 39.5% goes to the farmer.
  - 0.5% is recorded as the platform share.
- Administrative user management, farmer verification, project moderation, reports, and manual shareout finalization.

## How the workflow fits together

1. A landowner lists land and sends a hiring request to a verified farmer.
2. The farmer accepts the request, then creates a farming project for the accepted land.
3. An administrator approves or rejects the proposed project.
4. Investors fund approved projects. Funding updates are protected by a database transaction and row lock.
5. The farmer posts progress, completes the project, and records harvest value.
6. Positive profit is distributed once across confirmed investments, the farmer, and the platform.

See [Architecture](docs/ARCHITECTURE.md) for request flow and component responsibilities.

## Tech stack

| Layer | Technology |
| --- | --- |
| Server | PHP 8.0+ with sessions and typed classes |
| Database | MySQL 8.0+ or a compatible MariaDB release, using `mysqli` |
| UI | Server-rendered HTML, custom CSS, Tailwind CSS browser CDN |
| Fonts/icons | Google Fonts and Material Symbols CDN |
| Architecture | Lightweight MVC-style controllers, models, views, and page entry points |
| Dependencies | No Composer or npm packages are required |

Required PHP extensions: `mysqli` and `mbstring`. File uploads also require a writable `uploads/lands/` directory.

## Quick start

### 1. Clone and enter the project

```bash
git clone <repository-url> cashiconnect
cd cashiconnect
```

### 2. Create the development database

The included SQL file creates the `cc` database, drops and recreates the project tables, and loads demo records:

```bash
mysql -u root -p < chasiConnect.sql
```

> [!CAUTION]
> `chasiConnect.sql` contains `DROP TABLE IF EXISTS` statements. Import it only into a disposable development database or after backing up data you need.

For a GUI workflow, open phpMyAdmin, select the **Import** tab, and import `chasiConnect.sql`.

### 3. Configure the database connection

The application reads configuration from process environment variables and falls back to a standard local XAMPP-style configuration:

| Variable | Default | Purpose |
| --- | --- | --- |
| `DB_HOST` | `localhost` | Database server hostname |
| `DB_PORT` | `3306` | Database server port |
| `DB_DATABASE` | `cc` | Database name |
| `DB_USERNAME` | `root` | Database username |
| `DB_PASSWORD` | empty | Database password |
| `DB_CHARSET` | `utf8mb4` | Connection character set |

`.env.example` documents these names, but the application intentionally has no dotenv dependency and does not parse `.env` files. Define the values in Apache/Nginx/PHP-FPM, your container, or the shell that starts PHP.

PowerShell example:

```powershell
$env:DB_HOST = '127.0.0.1'
$env:DB_PORT = '3306'
$env:DB_DATABASE = 'cc'
$env:DB_USERNAME = 'root'
$env:DB_PASSWORD = ''
php -S 127.0.0.1:8000
```

Bash example:

```bash
export DB_HOST=127.0.0.1
export DB_PORT=3306
export DB_DATABASE=cc
export DB_USERNAME=root
export DB_PASSWORD=''
php -S 127.0.0.1:8000
```

### 4. Open the application

With PHP's development server running, visit:

- Home: `http://127.0.0.1:8000/home.php`
- Login: `http://127.0.0.1:8000/login.php`
- Registration: `http://127.0.0.1:8000/registration.php`

For XAMPP, place the folder below `htdocs`, start Apache and MySQL, then open the matching path, such as `http://localhost/cashiconnect/home.php`.

## Demo accounts

The seed file and login controller provide these development-only accounts:

| Role | Username | Password |
| --- | --- | --- |
| Administrator | `admin` | `admin` |
| Investor | `invest` | `invest` |
| Farmer | `farmer` | `farmer` |
| Landowner | `land` | `land` |

Never retain these accounts or password behavior in a deployed environment.

## Usage examples

### Try the complete project lifecycle

1. Sign in as `land`, add a land listing, find a verified farmer, and send a hiring request.
2. Sign in as `farmer`, accept the request, and submit a project using the leased land.
3. Sign in as `admin` and approve the pending project.
4. Sign in as `invest`, open the approved project, and invest up to its remaining budget.
5. Sign in as `farmer`, post progress, mark the fully funded project complete, and record a harvest.
6. Review the generated profit shares from the farmer, investor, or administrator views.

### Search for projects

Investor project search uses `ajax/search-projects.php`. The last non-empty search is stored in a short-lived cookie and reused when the project list is opened again.

## Project structure

```text
cashiconnect/
├── admin/                       # Admin page entry points and admin-specific views
├── ajax/                        # AJAX project-search endpoint
├── controllers/                 # Request validation and workflow orchestration
├── core/                        # Authentication, cookies, and DB connection singleton
├── farmer/                      # Farmer pages and workflow handlers
├── investor/                    # Investor pages and investment handlers
├── landowner/                   # Landowner pages and hiring handlers
├── models/                      # Database access and domain queries
├── views/                       # Shared or separated presentation templates
├── uploads/lands/               # Runtime land images; contents are ignored by Git
├── docs/                        # Architecture, DB, deployment, and security notes
│   ├── index.html               # GitHub Pages static product showcase
│   ├── static.css               # Showcase styling
│   └── static.js                # Showcase interactions and calculator
├── _profit-distribution-helper.php
├── chasiConnect.sql             # Destructive development schema and seed data
├── db.php                       # Legacy connection compatibility entry point
├── home.php                     # Public landing page
├── login.php                    # Authentication entry point
├── registration.php             # Account-registration entry point
└── style.css                    # Shared custom styles
```

## Documentation

- [Architecture and workflows](docs/ARCHITECTURE.md)
- [Database model and profit distribution](docs/DATABASE.md)
- [Deployment guide](docs/DEPLOYMENT.md)
- [Security and production readiness](docs/SECURITY.md)
- [Contributing](CONTRIBUTING.md)

## Verification

Run PHP syntax checks from the repository root:

```powershell
Get-ChildItem -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }
```

There is currently no automated test suite. Before merging changes, manually verify authentication and the role workflows described above against a disposable database.

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for setup expectations, branch guidance, checks, and pull-request requirements.

## License

No open-source license has been selected. Unless the repository owner adds a license, the source remains under standard copyright protection and no redistribution or reuse rights are granted implicitly.
