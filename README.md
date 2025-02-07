# Event Management System

## Overview

This is a simple web-based Event Management System built using pure PHP with **MVC architecture**. It provides essential event management functionalities along with a structured, maintainable, scalable codebase featuring a dynamic routing engine, models, custom validation class and many more. Live link <a href="https://event.hasib.info" target="_blank">https://event.hasib.info</a>

## Features

### 1. Mini MVC Framework

- **Custom Routing Engine**: Supports dynamic route.
- **Model-View-Controller (MVC) Pattern**: Ensures clean separation of concerns.
- **Eloquent-like ORM**: Provides simplified database interactions using models.
- **Middleware Support**: Allows authentication and request handling before controller execution.
- **Custom Validation Class**: Provides server-side validation for input data.

### 2. Core Event Management System Functionalities

- **User Authentication**: Secure login and registration with password hashing.
- **Event Management**: Create, update, view, and delete events.
- **Attendee Registration**: Users can register for events with capacity checks.
- **Event Dashboard**: Displays events in a paginated, sortable, and filterable format.
- **Event Reports**: Admins can download event attendee lists in CSV format.
- **Event Search**: Users can search for events by name, location or date.
- **Attendees Search**: Admins can search attendees by name, location, phone number or email.

### 4. Security & Validation

- **CSRF Protection**: Implemented token-based protection against cross-site request forgery attacks.
- **XSS Protection**: Used HTML escaping to prevent cross-site scripting attacks.
- **SQL Injection Protection**: Utilized PDO prepared statements to prevent SQL injection attacks.
- **Secure Password Hashing**: Uses `password_hash()` for safe authentication.
- **Custom Validation Class**: Validates input data consistently across the application.

### 5. Responsive UI

- **Bootstrap-powered UI**: Ensures a clean, responsive interface for all devices.

## Enhancements

- API endpoints for all the events and event details

```
| Endpoint                                  | Method |
|-------------------------------------------|--------|
| 'https://event.hasib.info/api/events'     | GET    |
| 'https://event.hasib.info/api/event/{id}' | GET    |
```

- Used AJAX for form submission

## Installation & Setup

### Prerequisites

- PHP (>=7.4)
- MySQL
- Apache

### Steps

1. Clone this repository:

   ```bash
   git clone https://github.com/mehedihasanhasib/event-management-system.git
   ```

2. Configure the `config/database.php` file as your database:

   ```bash
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'ollyo-test',
    'username' => 'root',
    'password' => '',
   ```

3. Create a database with the same name provided in the `config/database.php` file and import the provided database schema (`database.sql`) into MySQL (if face any error change database collation to `utf8mb4_general_ci` or `utf8mb4_unicode_ci`).

4. Open a terminal in the project root directory and start a local server by running the following command:

   ```bash
   php -S localhost:8000 -t public
   ```

5. Access the system at `http://localhost:8000`

## Demo Account Credentials

**Email:** demo@example.com

**Password:** 12345678
