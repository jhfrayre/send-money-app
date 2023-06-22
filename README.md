# send-money-app
A sample application that can send money to users using Laravel as the API and Vue as the frontend.

## Prerequisites
The version numbers only serve as guides. The exact version is not necessarily required.
- Docker Desktop or Docker Community Edition (Docker CE v24.0 (rootless))
- Composer (v2.2.6)

## Setup
1. Clone the repository.

2. Create `env` files.
```bash
cd payment-service/api/src
cp .env.example .env
cd ../../../payment-app
cp .env.example .env
```

3. Generate vendor files using Composer
```bash
cd ../payment-service/api/src
composer install
```

3. Build the images and start the containers.
```bash
cd ../../..
docker-compose build
docker-compose up -d
```

4. Generate app keys. Run this step in the initial setup or when the APP_KEY values in the .env files are empty.
```bash
docker exec -ti payment-service php artisan key:generate
docker container restart payment-service
```
5. Install other dependencies and run migrations
```bash
docker exec -it payment-service sh ./install.sh
```
6. Use Adminer to populate the database tables. Execute the payment-service/database/schema/create_tables_and_insert_data.sql
```
Adminer - http://localhost:8083/
System: MySQL
Server: payment-sql
Username: payment-service
Password: payment-pass
Database: payments_db
```

7. Run the Payment App
```bash
cd payment-app
npm install
npm run dev
```

## Testing
#### NOTE: Please note that running tests currently inputs into the database without refreshing.
```bash
docker exec -it payment-service ./vendor/bin/pest
```
Alternatively, you can run Bash interactively and run the tests
```bash
docker exec -it payment-service bash

bash-5.1# ./vendor/bin/pest
```

## Development Helpers
```bash
## Payment App
npm run format
npm run lint
```

## Services
```
Payment App - http://localhost:5173/
Payment Service - http://localhost:8070/
```

## Test Accounts
Users can log in to the Payment App using the following test accounts
```
name: Test User
email: test@example.com
password: password

name: Test User 2
email: test2@example.com
password: password
```
