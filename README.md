# Attendance Tracking System

A Laravel-based web application for tracking user attendance via ID number input, with real-time logs and notifications.

## Features

- **Attendance Logging:** Users can log their attendance using their ID number.
- **Real-Time Logs:** View attendance logs instantly after submission.
- **User Authentication:** Registration, login, password reset, and email verification.
- **Role & Permission Management:** Middleware and controllers for user roles and permissions.
- **Profile Management:** Update user profiles and passwords.
- **Notifications:** Email notifications for approvals and other events.
- **Extensible:** Easily add courses, students, and patterns for ID validation.

## UI & Copyright Notice

This project uses [AdminLTE](https://adminlte.io/) as its main dashboard and UI template.  
**AdminLTE is an open source admin dashboard template licensed under the MIT License.**  
See [AdminLTE License](https://github.com/ColorlibHQ/AdminLTE/blob/master/LICENSE) for details.

## 🚀 Features

- ✅ **Attendance Logging** – Users log attendance with their ID number.  
- ✅ **Time Tracking** – Logs `Time In` (AM/PM) and `Time Out` (AM/PM).  
- ✅ **Real-Time Logs** – Instantly view attendance punches.  
- ✅ **User Authentication** – Login, register, password reset, and email verification.  
- ✅ **Role & Permission Management** – Control access by role (Admin, User, etc.).  
- ✅ **Profile Management** – Users can update their profile and password.  
- ✅ **Notifications** – Real-time and email-based notifications.  
- ✅ **Extensible** – Add courses, students, and ID validation patterns.

---

## 📂 Folder Structure

- `app/Http/Controllers` → Attendance, Auth, and User controllers  
- `app/Models` → Eloquent models (Attendance, Student, User, etc.)  
- `app/Mail` → Email notifications  
- `app/Rules` → Custom validation rules  
- `resources/views` → Blade templates (AdminLTE UI)  
- `routes/web.php` → Web routes  

---

## ⚙️ Requirements

Make sure your system has:

- **PHP** >= 8.0  
- **Composer**  
- **Node.js & npm**  
- **MySQL/MariaDB**  
- **Git**  

### Required PHP Extensions
Enable these in `php.ini`:
```ini
extension=gmp
extension=gd
extension=pdo_mysql
extension=mbstring
extension=tokenizer
extension=openssl
extension=curl
extension=fileinfo

### 🔧 Installation

### Clone the repository

git clone https://github.com/tyser1995/attendance-tracking.git
cd attendance-tracking


### Install dependencies

composer install
npm install && npm run dev


### Environment setup

cp .env.example .env


Update .env with your DB and mail settings:

APP_NAME="Attendance Tracking"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=attendance_db
DB_USERNAME=root
DB_PASSWORD=


### Generate app key

php artisan key:generate


### Run migrations & seeders

php artisan migrate --seed


### Start the server

php artisan serve


Visit 👉 http://127.0.0.1:8000

```

### 👤 Default Admin Login

- **Email: admin@gmail.com
- **Password: admin1234
- **(Change this after login)

### 🛠 Troubleshooting

- **Missing PHP extensions → Enable them in php.ini.
- **Node build errors → Delete node_modules then run npm install.
- **Database issues → Ensure .env matches your DB credentials.
