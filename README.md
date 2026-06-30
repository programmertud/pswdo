# CSWDO — Children Social Welfare & Development Office
## Surigao del Norte Database on Children 2025

---

## Requirements
- PHP 8.1+
- Composer
- MySQL 8.0+ or MariaDB 10.4+
- Node.js 18+ (optional, for Vite assets if needed)

---

## Installation

### 1. Clone / extract the project
```bash
cd /var/www
# Place the cswdo folder here
cd cswdo
```

### 2. Install PHP dependencies
```bash
composer install
```

### 3. Copy environment file
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure your database in `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cswdo_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Create the database
```sql
CREATE DATABASE cswdo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Run migrations
```bash
php artisan migrate
```

### 7. Seed with 2025 data from Surigao del Norte
```bash
php artisan db:seed
```

### 8. Run the dev server
```bash
php artisan serve
```

Then open: **http://localhost:8000**

---

## Project Structure

```
cswdo/
├── app/Http/Controllers/
│   ├── DashboardController.php     ← KPI stats & charts
│   ├── RecordsController.php       ← All 6 record views
│   └── AddRecordController.php     ← Add/Update forms (6 categories)
│
├── database/
│   ├── migrations/
│   │   └── 2025_01_01_000001_create_children_records_table.php
│   └── seeders/
│       └── DatabaseSeeder.php      ← Full 2025 dataset pre-loaded
│
├── resources/views/
│   ├── layouts/app.blade.php       ← Master layout with sidebar
│   ├── dashboard/index.blade.php   ← Dashboard with stats & charts
│   └── records/
│       ├── population.blade.php
│       ├── survival.blade.php
│       ├── development.blade.php
│       ├── protection.blade.php
│       ├── disability.blade.php
│       ├── ip.blade.php
│       └── add.blade.php           ← Tabbed add/update form
│
└── routes/web.php                  ← All routes
```

---

## Database Tables

| Table | Description |
|---|---|
| `lgu_populations` | Total children by LGU (Male/Female/Total) |
| `survival_records` | Immunization %, 0-59 months, pregnant adolescents |
| `development_records` | Children in school, ECCD enrollees |
| `protection_records` | CNSP cases, CAR/CICL data |
| `children_with_disability` | PWD children by LGU |
| `ip_children` | Indigenous Peoples children |

---

## Features

### Dashboard
- 6 KPI summary cards (total population, immunization avg, disability, CNSP, IP, pregnant adolescents)
- Top 5 LGUs by child population (bar chart)
- Immunization rate gauge chart for all 21 LGUs (color-coded: green ≥85%, amber 70-84%, red <70%)
- Quick access navigation buttons

### Records
- Searchable, sortable tables for all 6 categories
- Totals/grand total rows
- Color-coded status pills
- Null-safe display (shows — for missing data)

### Add / Update Record
- Tabbed form (6 categories in one page)
- LGU dropdown (all 21 municipalities + Surigao City)
- Smart upsert: updates if LGU exists, inserts if new
- Validation with error display
- Flash success messages

---

## Pre-loaded Data (2025)
All 21 LGUs from the official Surigao del Norte Database on Children 2025:
Alegria, Bacuag, Burgos, Claver, Dapa, Del Carmen, General Luna, Gigaquit,
Mainit, Malimono, Pilar, Placer, San Benito, San Franciso, San Isidro,
Santa Monica, Sison, Socorro, Tagana-an, Tubod, Surigao City

---

## Prepared by
PCPC Secretariat — Surigao del Norte
PCPC Chairperson: Robert Lyndon S. Barbers
