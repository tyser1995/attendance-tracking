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

## Folder Structure

- `app/Console/Commands`: Custom Artisan commands.
- `app/Events`: Application events.
- `app/Exceptions`: Exception handling.
- `app/Helpers`: Global helper functions.
- `app/Http/Controllers`: Main controllers (Attendance, User, Auth, etc.).
- `app/Http/Middleware`: Custom and default middleware.
- `app/Http/Requests`: Form request validation.
- `app/Mail`: Email notification classes.
- `app/Models`: Eloquent models (Attendance, User, Student, etc.).
- `app/Providers`: Service providers.
- `app/Rules`: Custom validation rules.
- `app/View/Components`: Blade components.

## Getting Started

### Prerequisites

- PHP >= 7.3
- Composer
- Node.js & npm
- MySQL or compatible database

### Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/tyser1995/attendance-tracking.git
   cd attendance-tracking
