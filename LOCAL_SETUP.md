# Garikinbo Local Environment

The repository now ships with Docker so you can run the full stack plus a MySQL instance that any SQL client (including the MySqoid extension) can attach to.

## Requirements
- Docker Desktop 4.25+ (includes Docker Compose v2)
- Ports `8080` (web) and `3306` (MySQL) available on your machine
- Optional: the MySqoid VS Code extension or any MySQL client

## Boot the stack
1. From the project root run `docker compose up --build -d`.
2. Wait for the `garikinbo_db` container to report `healthy` (`docker compose ps`).
3. Browse the app at [http://localhost:8080](http://localhost:8080). The PHP container injects `APP_URL=http://localhost:8080`, so internal links and the API automatically point to the right host.

The compose file wires the repo into `/var/www/html`, so any file changes you make on the host are reflected live. If you change dependencies, rebuild with `docker compose up --build`.

## Database + MySqoid access
- Host: `127.0.0.1`
- Port: `3306`
- User: `auction`
- Password: `auction`
- Default DB: `car_auction`

The first time the MySQL container starts it seeds itself from `car_auction.sql`, so you immediately see the sample users, cars, auctions, etc. To connect via MySqoid:
1. Open the extension.
2. Create a new MySQL connection using the credentials above.
3. Expand the `car_auction` schema to browse tables, run queries, or edit data. Changes are instantly reflected in the running app because both containers share the same database.

## Useful commands
- `docker compose logs -f app` – watch Apache/PHP logs
- `docker compose logs -f db` – watch the MySQL server (helpful if the import fails)
- `docker compose down` – stop the environment and retain the MySQL volume
- `docker compose down -v` – stop the environment and delete the MySQL volume (the schema will be re-imported next start)

## Manual setup (if you skip Docker)
1. Create a MySQL database named `car_auction`.
2. Import `car_auction.sql` (e.g. `mysql -u root -p car_auction < car_auction.sql`).
3. Ensure PHP 8.2+ with `pdo_mysql` is installed and serve the repo from `http://localhost/bid` **or** update `APP_URL` in `config.php`.
4. Configure your MySqoid connection to hit the DB credentials you used in step 1.

Either approach gives you a fully live site plus a database you can inspect/edit from the extension.
