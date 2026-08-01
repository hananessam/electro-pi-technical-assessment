<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Electro PI Technical Assessment

A modular Laravel 13 API application built with [nwidart/laravel-modules](https://docs.laravelmodules.com/). Currently includes an `Auth` module exposing registration, login, and logout endpoints, a `Project` module exposing CRUD endpoints for managing projects, and a `Task` module exposing CRUD endpoints for managing tasks scoped to a project (see [openapi.yaml](openapi.yaml) for full API documentation).

## Requirements

- PHP 8.3+
- Composer
- MySQL (or another database supported by Laravel)

## Setup

1. Clone the repository and install dependencies:

    ```bash
    composer install
    ```

2. Copy the environment file and generate an application key:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. Configure your database connection in `.env` (defaults to MySQL):

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4. Run database migrations:

    ```bash
    php artisan migrate
    ```

Alternatively, steps 1-4 can be run in one go with:

```bash
composer run setup
```

## Running the app

Start the application along with the queue worker, log viewer, and Vite dev server:

```bash
composer run dev
```

Or serve the application alone:

```bash
php artisan serve
```

## Running tests

```bash
composer run test
```

or

```bash
php artisan test --compact
```

## Modules

This project uses [nwidart/laravel-modules](https://docs.laravelmodules.com/) to organize domain functionality under the `Modules/` directory.

| Module | Description |
|--------|-------------|
| `Auth` | User registration, login, and logout via Laravel Sanctum |
| `Project` | CRUD management of projects (authenticated via Laravel Sanctum) |
| `Task` | CRUD management of tasks scoped to a project (authenticated via Laravel Sanctum) |

## API Documentation

API endpoints are documented using the OpenAPI 3.0 specification in [openapi.yaml](openapi.yaml).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
