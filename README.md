# 📋 TaskApp

A full-stack Task Management Application built with **Laravel 10** (Blade + API) and **React 19** (Vite).

![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?logo=laravel&logoColor=white)
![React](https://img.shields.io/badge/React-19-61DAFB?logo=react&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white)
![Sanctum](https://img.shields.io/badge/Auth-Sanctum-FF2D20)

---

## 📖 Project Overview

TaskApp is a project management web application built as **two independent implementations**:

| Version | Stack | Description |
|---------|-------|-------------|
| **V1** | Laravel + Blade | Traditional MVC with Blade templates, custom CSS, session-based auth |
| **V2** | Laravel API + React | RESTful JSON API with Sanctum tokens; React 19 SPA frontend |

Both versions share the **same database**, **models**, **migrations**, and **business logic**.

---

## ✨ Features

- 🔐 **Authentication** — Register, Login, Logout, Email Verification, Forgot/Reset Password
- 📁 **Project Management** — Create, Read, Update, Delete projects
- ✅ **Task Tracking** — Add tasks to projects, toggle completion, complete all
- 📊 **Dashboard Analytics** — Stats cards, completion rates, recent projects
- 👤 **Profile Management** — Update name, email, password, delete account
- 📧 **Contact Form** — Send messages with subject and body
- 🛡️ **Secure API** — Sanctum token-based authentication for React SPA
- 📱 **Responsive Design** — Works on desktop and mobile

---

## 🗄️ Database Schema

| Table | Fields |
|-------|--------|
| `users` | id, name, email, password, remember_token, timestamps |
| `projects` | id, id_user (FK), name, description, status, timestamps |
| `tasks` | id, id_project (FK), title, description, status, timestamps |
| `contacts` | id, id_user (FK), name, email, subject, message, timestamps |
| `personal_access_tokens` | id, tokenable_type, tokenable_id, name, token, abilities, last_used_at |

### Relationships
- `users` 1 → ∞ `projects`
- `projects` 1 → ∞ `tasks`
- `users` 1 → ∞ `contacts`

---

## 🚀 Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 10, PHP 8.1+ |
| **Frontend V1** | Blade Templates, Custom CSS |
| **Frontend V2** | React 19, Vite, Axios, React Router v6, Lucide Icons |
| **API Auth** | Laravel Sanctum (Token-based) |
| **Database** | MySQL |
| **Email** | Laravel Mail (Verification, Password Reset) |

---

## 📡 API Endpoints (V2)

### Public Routes (No Auth)

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/register` | Register new user |
| POST | `/api/login` | Login user |
| POST | `/api/forgot-password` | Send password reset link |
| POST | `/api/reset-password` | Reset password |
| GET | `/api/email/verify/{id}/{hash}` | Verify email address |

### Protected Routes (Bearer Token Required)

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/logout` | Logout user |
| GET | `/api/user` | Get authenticated user |
| POST | `/api/email/verification-notification` | Resend verification email |
| GET | `/api/email/check-verification` | Check verification status |
| GET | `/api/profile` | Get user profile |
| PUT | `/api/profile` | Update profile (name, email) |
| PUT | `/api/profile/password` | Update password |
| DELETE | `/api/profile` | Delete account |
| GET | `/api/dashboard` | Dashboard statistics |
| POST | `/api/contact` | Send contact message |
| GET | `/api/projects` | List all projects |
| POST | `/api/projects` | Create project |
| GET | `/api/projects/{id}` | Get project with tasks |
| PUT | `/api/projects/{id}` | Update project |
| DELETE | `/api/projects/{id}` | Delete project |
| PATCH | `/api/projects/{id}/status` | Update project status |
| GET | `/api/projects/{id}/tasks` | List tasks for project |
| POST | `/api/projects/{id}/tasks` | Create task |
| PATCH | `/api/tasks/{id}/toggle` | Toggle task status |
| POST | `/api/projects/{id}/complete-all` | Complete all tasks |
| DELETE | `/api/tasks/{id}` | Delete task |

---

## 📄 Pages

### V1 (Laravel Blade)
- Welcome (Landing page)
- Login / Register / Forgot Password / Reset Password
- Verify Email / Confirm Password
- Dashboard (Stats + Recent Projects)
- Projects (CRUD with search)
- Project Detail (Tasks list with inline add/toggle/delete)
- About (Features + Tech Stack)
- Contact (Form with email/location/hours)
- Profile (Update info, password, delete account)

### V2 (React SPA)
- Welcome (Landing page with hero + features)
- Login / Register / Forgot Password / Reset Password
- Dashboard (Stats cards + recent projects)
- Projects (Card grid, search, create/edit modal)
- Project Detail (Task list with inline actions)
- About (Features + Tech Stack)
- Contact (Form submission)
- Profile (Update info, password, delete account)

---

## 🛠️ Installation

### Prerequisites
- PHP 8.1+
- Composer
- Node.js 18+
- MySQL

### Setup

```bash
# Clone the repository
git clone https://github.com/yourusername/taskapp.git
cd taskapp

# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Update .env with your database credentials
# DB_DATABASE=taskapp
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations
php artisan migrate

# Start Laravel server (V1)
php artisan serve
# Visit: http://127.0.0.1:8000

# For React SPA (V2)
cd react-frontend
npm install
npm run dev
# Visit: http://localhost:5173
