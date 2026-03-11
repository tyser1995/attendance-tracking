# Attendance Tracking System

A Laravel 8 web application for student attendance tracking via ID number input, with AM/PM time-in/time-out logging, course and student management, role-based access control, and an admin dashboard.

## UI

This project uses [AdminLTE](https://adminlte.io/) as its dashboard UI template, licensed under the [MIT License](https://github.com/ColorlibHQ/AdminLTE/blob/master/LICENSE).

---

## Features

- **Attendance Logging** — Students log attendance by entering their ID number; supports AM Time In, AM Time Out, PM Time In, PM Time Out (max 4 logs/day)
- **ID Pattern Validation** — Configurable regex patterns to validate ID number formats before logging
- **Student Management** — CRUD for students with course assignment
- **Course Management** — CRUD for courses with year level
- **Role & Permission Management** — Granular access control via Spatie Permission
- **User Management** — Create and manage admin/staff accounts
- **Export** — Export attendance records to Excel, CSV, and PDF
- **Booking System** — Manage accommodations, day tours, and place reservations
- **Survey & Feedback** — Collect and review survey responses
- **Volunteer Management** — Register and approve volunteers
- **Announcements** — Post announcements visible on the public page
- **Reports & Charts** — Visual reports for bookings, demographics, and feedback
- **Price Monitoring** — Track commodity prices
- **Point of Sale** — Basic POS item management
- **QR Code Generator** — Generate and verify QR codes

---

## Requirements

- **PHP** >= 8.0
- **Composer**
- **Node.js & npm**
- **MySQL** >= 5.7

### Required PHP Extensions

Enable in `php.ini`:

```ini
extension=gd
extension=pdo_mysql
extension=mbstring
extension=openssl
extension=curl
extension=fileinfo
extension=gmp
```

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/tyser1995/attendance-tracking.git
cd attendance-tracking
```

### 2. Install dependencies

```bash
composer install
npm install && npm run dev
```

### 3. Environment setup

```bash
cp .env.example .env
```

Edit `.env` with your database credentials:

```env
APP_NAME="Attendance Tracking"
APP_ENV=local
APP_DEBUG=false
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate app key

```bash
php artisan key:generate
```

### 5. Run migrations and seeders

```bash
php artisan migrate --seed
```

### 6. Start the server

```bash
php artisan serve
```

Visit → [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Default Login Credentials

| Role        | Email                   | Password       |
|-------------|-------------------------|----------------|
| Super Admin | superadmin@gmail.com    | SuperAdmin1234 |
| Admin       | admin@gmail.com         | admin1234      |

> Change these passwords immediately after first login.

---

## Project Structure

```
app/
├── Http/Controllers/     — Attendance, Student, Course, User, Role controllers
├── Models/               — Eloquent models (Attendance, Student, Course, User, etc.)
├── Helpers/              — GlobalHelper utility
database/
├── migrations/           — All table migrations
├── seeders/              — Role, Permission, and Admin user seeders
resources/views/          — Blade templates (AdminLTE)
routes/
└── web.php               — All web routes
```

---

## Troubleshooting

| Problem | Fix |
|---|---|
| Missing PHP extensions | Enable them in `php.ini` and restart your server |
| `No application encryption key` | Run `php artisan key:generate` |
| `Unknown database` error | Create the database first, then run `php artisan migrate` |
| Node build errors | Delete `node_modules/` and re-run `npm install` |
| Blank page / 500 error | Check `storage/logs/laravel.log` for details |
