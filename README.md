<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Electro PI Technical Assessment

A modular Laravel 13 API application built with [nwidart/laravel-modules](https://docs.laravelmodules.com/). Currently includes an `Auth` module exposing registration, login, and logout endpoints, a `Project` module exposing CRUD endpoints for managing projects, a `Task` module exposing CRUD endpoints for managing tasks scoped to a project, and a top-level dashboard endpoint that aggregates project and task stats for the authenticated user (see [openapi.yaml](openapi.yaml) for full API documentation).

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

## Docker

Alternatively, run the app in Docker (a PHP 8.4 container plus MySQL) without installing PHP/Composer locally:

Docker uses its own env file, `.env.docker`, kept separate from your local `.env` so the two setups (native MySQL on `127.0.0.1` vs. the `db` container) never fight over credentials:

1. Create `.env.docker` in the project root:

    ```bash
    cat > .env.docker <<'EOF'
    DB_DATABASE=projects_electro_pi_technical_assessment
    DB_USERNAME=laravel
    DB_PASSWORD=secret
    EOF
    ```

    `DB_USERNAME` must not be `root` — the MySQL image refuses to configure `MYSQL_USER=root`.

2. Build and start the containers, then run migrations and seed the database:

    ```bash
    docker compose --env-file .env.docker up -d --build
    docker compose exec app php artisan migrate
    docker compose exec app php artisan db:seed
    ```

The app is then available at http://localhost:8000. `docker-compose.yml` reads `.env.docker` (via `--env-file`) to configure the `db` service and to inject `DB_HOST`/`DB_DATABASE`/`DB_USERNAME`/`DB_PASSWORD` into the `app` container's environment — these take precedence over the `.env` file inside the container, which is scaffolded from `.env.example` with a freshly generated `APP_KEY` on first start. Re-run `docker compose --env-file .env.docker up -d --build` after changing code, since the image isn't live-mounted. If you also run MySQL natively on your machine, stop it first or it will collide with the `db` container's port 3306.

## Running tests

```bash
composer run test
```

or

```bash
php artisan test --compact
```

Tests run against an in-memory SQLite database (configured in `phpunit.xml`), so they never touch your local `.env` database.

## Manual Testing

1. Seed the database with sample data — this creates two users (`test@example.com` and `test2@example.com`, both with password `password`), several projects in every status, and tasks covering done/pending/overdue:

    ```bash
    php artisan migrate:fresh --seed
    ```

2. Start the app:

    ```bash
    php artisan serve
    ```

3. Log in to get a Sanctum token:

    ```bash
    curl -s -X POST http://localhost:8000/api/v1/auth/login \
      -H "Content-Type: application/json" \
      -d '{"email":"test@example.com","password":"password"}'
    ```

    Copy the `access_token` from the response and export it for the following requests:

    ```bash
    export TOKEN="paste-the-access_token-here"
    ```

4. Exercise the endpoints, e.g.:

    ```bash
    # List projects (paginated)
    curl -s http://localhost:8000/api/v1/projects \
      -H "Authorization: Bearer $TOKEN"

    # Filter + paginate projects
    curl -s "http://localhost:8000/api/v1/projects?status=active&per_page=2" \
      -H "Authorization: Bearer $TOKEN"

    # Filter tasks by status/priority and search by title
    curl -s "http://localhost:8000/api/v1/tasks?status=todo&priority=high&title=bug" \
      -H "Authorization: Bearer $TOKEN"

    # Create a task
    curl -s -X POST http://localhost:8000/api/v1/tasks \
      -H "Authorization: Bearer $TOKEN" -H "Content-Type: application/json" \
      -d '{"project_id":1,"title":"Fix the header","status":"todo","priority":"high"}'

    # Dashboard summary
    curl -s http://localhost:8000/api/v1/dashboard \
      -H "Authorization: Bearer $TOKEN"
    ```

    Log in as `test2@example.com` (same password) with a separate token to confirm ownership scoping — that user's requests only ever see their own projects/tasks, and touching `test@example.com`'s records returns `403`.

    Full request/response shapes for every endpoint are documented in [openapi.yaml](openapi.yaml).

### Postman

Prefer a GUI? Import [postman_collection.json](postman_collection.json) into Postman. Its **Login** request has a test script that automatically saves the response's `access_token` into the collection's `token` variable, and the collection's auth is set to `Bearer {{token}}` — so every other request in the collection is authenticated automatically once you run Login, with no manual copy/paste. Update the `base_url`, `project_id`, and `task_id` collection variables as needed.

## Modules

This project uses [nwidart/laravel-modules](https://docs.laravelmodules.com/) to organize domain functionality under the `Modules/` directory.

| Module | Description |
|--------|-------------|
| `Auth` | User registration, login, and logout via Laravel Sanctum |
| `Project` | CRUD management of projects (authenticated via Laravel Sanctum) |
| `Task` | CRUD management of tasks scoped to a project (authenticated via Laravel Sanctum) |

A `GET /api/v1/dashboard` endpoint (defined in the root app, outside the modules) aggregates project and task counts for the authenticated user: total/active projects and total/completed/pending/overdue tasks.

## API Documentation

API endpoints are documented using the OpenAPI 3.0 specification in [openapi.yaml](openapi.yaml).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
