# SOHO GÜVENLİK - Web Platform

This project is composed of two main parts:

1.  **Backend**: A Laravel API.
2.  **Frontend**: A React Application (Vite).

## Prerequisites

- **XAMPP** (or any PHP/MySQL environment)
- **Node.js** & **npm**
- **Composer**

---

## Quick Start Guide

You need to run both the backend and frontend terminals simultaneously.

### 1. Start the Backend (Laravel)

1.  Open a terminal.
2.  Navigate to the `backend` directory:
    ```bash
    cd backend
    ```
3.  Ensure your database is running(start MySQL in XAMPP control panel).
4.  Start the Laravel development server:
    ```bash
    php artisan serve
    ```
    _The API will run at `http://127.0.0.1:8000`_

### 2. Start the Frontend (React)

1.  Open a **new** terminal.
2.  Navigate to the `frontend` directory:
    ```bash
    cd frontend
    ```
3.  Start the Vite development server:
    ```bash
    npm run dev
    ```
    _The website will run at `http://localhost:5173` (or similar)_

---

## Admin Panel Access

- **URL**: `http://localhost:5173/admin/login`
- **Email**: `admin@sohoguvenlik.com`
- **Password**: `password`

## Project Structure

- `backend/`: Laravel 10 API (Controllers, Models, Migrations)
- `frontend/`: React + Tailwind CSS (Pages, Components, Contexts)
