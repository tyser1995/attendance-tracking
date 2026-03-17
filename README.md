# Attendance Tracking System

A Laravel 8 web application for managing student attendance with AM/PM time-in/out logging, course enrollment, role-based access control, and supporting modules for bookings, surveys, volunteers, and POS transactions.

---

## Features

### Core
- **Student Attendance** — AM Time In/Out + PM Time In/Out (up to 4 logs per day per student)
- **ID Pattern Validation** — configurable regex patterns to whitelist valid student ID formats
- **Student Management** — CRUD with soft deletes; students belong to courses
- **Course Management** — assign courses to students; used for attendance grouping
- **Date Range Filtering** — filter attendance records by date range on the index view

### Admin & Access
- **Role-Based Access Control** — powered by Spatie Laravel Permission
- **User Management** — create/edit users, assign roles and permissions
- **Permission Middleware** — route-level permission enforcement

### Additional Modules
- **Booking System** — day tours, overnight stays, place reservations
- **Survey Module** — collect and store guest survey responses
- **Volunteer Management** — volunteer registration and status tracking
- **Notifications** — in-app notification model
- **QR Code Generation** — via `simplesoftwareio/simple-qrcode`
- **Excel Export** — via `maatwebsite/excel`
- **Stripe Payments** — payment processing integration
- **Real-time Broadcasting** — Pusher integration
- **PWA Support** — via `ladumor/laravel-pwa`
- **Social Login** — via Laravel Socialite

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 8 (PHP ^7.4 / ^8.0) |
| Database | MySQL |
| Frontend | Blade, jQuery, DataTables, SweetAlert2 |
| Auth & RBAC | Laravel Auth + Spatie Laravel Permission ^5 |
| Excel | Maatwebsite Excel ^3.1 |
| Images | Intervention Image ^2.7 |
| Payments | Stripe PHP ^16 |
| Broadcasting | Pusher PHP Server ^7.2 |
| QR Codes | SimpleSoftwareIO Simple QrCode ^4.2 |

---

## Requirements

- PHP >= 7.4
- Composer
- MySQL
- Node.js & NPM

---

## Installation

```bash
# 1. Clone the repository
git clone <repo-url>
cd attendance-tracking

# 2. Install PHP dependencies
composer install

# 3. Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# 4. Configure your database in .env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# 5. Run migrations
php artisan migrate

# 6. Seed default roles and admin users
php artisan db:seed

# 7. Install and compile frontend assets
npm install && npm run dev
```

---

## Environment Variables

Key variables to configure in `.env`:

```env
APP_DEBUG=false
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mysql_er
DB_USERNAME=root
DB_PASSWORD=

# Pusher (real-time broadcasting)
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

# VAPID (web push notifications)
VAPID_PUBLIC_KEY=
VAPID_PRIVATE_KEY=
VAPID_SUBJECT=http://localhost

# Mail
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
```

---

## Default Credentials

Seeded by `CreateAdminUserSeeder`. **Change these immediately in production.**

| Role | Email | Password |
|---|---|---|
| Super Admin | superadmin@gmail.com | SuperAdmin1234 |
| Admin | admin@gmail.com | admin1234 |

---

## Attendance Logic

Each student can log up to **4 times per day**:

| Log # | Status |
|---|---|
| 1 | AM Time In |
| 2 | AM Time Out |
| 3 | PM Time In |
| 4 | PM Time Out |

- Logs 1 and 3 create a new attendance row.
- Logs 2 and 4 update the most recent row with `time_out`.
- A 5th scan on the same day returns an error.

---

## ID Pattern Validation

Admins can define ID patterns using `#` as a digit placeholder (e.g., `STU-####-##`). These are converted to regex anchors and stored in the `id_patterns` table. Attendance submission validates the scanned ID against all active patterns before looking up the student.

---

## Database Schema (Core Tables)

| Table | Purpose |
|---|---|
| `users` | Admin/staff accounts |
| `students` | Student records (soft deletes) |
| `courses` | Course catalog |
| `attendances` | Attendance logs (indexed on `idnumber`, `created_date`) |
| `id_patterns` | Regex patterns for ID validation |
| `roles` / `permissions` | Spatie RBAC tables |

---

## Known Limitations

- **Laravel 8 is EOL** — upgrade to Laravel 10+ is recommended
- **No test coverage** — PHPUnit is installed but no tests are written
- **Binary profile photos stored in DB** — consider switching to file-based storage
- **No audit logging** — critical operations (delete, role changes) are not logged
- `HomeController::booking()` and `getRoomDetails()` reference a missing `Accomodation` model and will throw a fatal error if those routes are visited
- `StudentController`, `CourseController`, and `AttendanceController` use only `auth` middleware — no permission-level gate checks

---

## Security Notes

- `APP_DEBUG` is set to `false` in `.env.example`
- Attendance POST route is rate-limited (`throttle:30,1`)
- VAPID keys are loaded from environment variables, not hardcoded
- ID pattern input is validated against an allowlist regex before storage
- All Blade output uses `{{ }}` escaping; jQuery DOM manipulation uses `.text()` to prevent XSS
- CSRF protection is enabled on all state-changing routes
