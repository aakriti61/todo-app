# Laravel To-Do List with Categories & Authentication

A full-stack task management web app built with Laravel, featuring user authentication, task-category relationships, and per-user data scoping. Built as a hands-on project to deepen Laravel skills beyond basic CRUD — specifically authentication and Eloquent relationships.

## Features

- User registration, login, and logout (via Laravel Breeze)
- Each user only sees and manages their own tasks and categories
- Create, edit, and delete tasks
- Create, edit, and delete categories
- Assign multiple categories to a single task (many-to-many relationship)
- Mark tasks as complete/incomplete with a single click
- Optional due dates and descriptions per task
- Server-side validation on all forms
- Dark mode support

## Tech Stack

- **Backend:** Laravel 12
- **Authentication:** Laravel Breeze (Blade + Alpine.js stack)
- **Database:** SQLite
- **Frontend:** Blade templating engine, Tailwind CSS, Alpine.js
- **Tools:** XAMPP, VS Code, Git

## Database Schema

**users** (created by Breeze)
| Field | Type |
|---|---|
| id | bigint |
| name | string |
| email | string, unique |
| password | hashed string |

**categories**
| Field | Type | Notes |
|---|---|---|
| id | bigint | Primary key |
| user_id | foreign key → users.id | Cascades on delete |
| name | string | |

**tasks**
| Field | Type | Notes |
|---|---|---|
| id | bigint | Primary key |
| user_id | foreign key → users.id | Cascades on delete |
| title | string | |
| description | text | Nullable |
| due_date | date | Nullable |
| completed | boolean | Defaults to false |

**category_task** (pivot table for many-to-many relationship)
| Field | Type |
|---|---|
| id | bigint |
| category_id | foreign key → categories.id |
| task_id | foreign key → tasks.id |

## Relationships

- A `User` has many `Tasks` and many `Categories`
- A `Task` belongs to one `User`
- A `Category` belongs to one `User`
- A `Task` belongs to many `Categories`, and a `Category` belongs to many `Tasks` (many-to-many via `category_task`)

## Routes

| Method | URI | Action |
|---|---|---|
| GET | /register, /login | Auth pages |
| GET | /dashboard | User dashboard (auth required) |
| GET | /tasks | List user's tasks |
| GET | /tasks/create | Show create task form |
| POST | /tasks | Store new task |
| GET | /tasks/{id}/edit | Show edit task form |
| PUT/PATCH | /tasks/{id} | Update task |
| DELETE | /tasks/{id} | Delete task |
| PATCH | /tasks/{id}/toggle | Toggle task completion |
| GET | /categories | List user's categories |
| GET | /categories/create | Show create category form |
| POST | /categories | Store new category |
| GET | /categories/{id}/edit | Show edit category form |
| PUT/PATCH | /categories/{id} | Update category |
| DELETE | /categories/{id} | Delete category |

## Installation / Running Locally

1. Clone the repository
git clone https://github.com/aakriti61/todo-app.git
cd todo-app

2. Install PHP dependencies
composer install

3. Install JavaScript dependencies
npm install

4. Copy the environment file and generate an app key
copy .env.example .env
php artisan key:generate

5. Create the SQLite database file
New-Item database\database.sqlite -ItemType File

6. Run migrations
php artisan migrate

7. Build frontend assets
npm run build

8. Start the development server
php artisan serve

9. Visit `http://127.0.0.1:8000/register` to create an account, then explore the app

## What I Learned

- Implementing authentication using Laravel Breeze
- Eloquent relationships: `hasMany`, `belongsTo`, and `belongsToMany`
- Working with pivot tables and the `sync()` method for many-to-many data
- Scoping database queries to the logged-in user to prevent unauthorized data access (IDOR prevention)
- Eager loading (`with()`) to avoid the N+1 query problem
- Handling checkbox arrays in forms and validating array input
- Defining custom, non-resource routes (e.g., a toggle-completion endpoint)

## Author

Aakriti Simkhada
[aakriti206105@gmail.com](mailto:aakriti206105@gmail.com)