# send-money-app
A sample application to send money using Laravel.

## Setup
1. Clone the repository.

2. Create `env` files.
```
cd payment-service/api/src
cp .env.example .env
cd ../../../payment-app/web/src
cp .env.example .env
```

3. Build the images and start the containers.
```
cd ../../..
docker-compose build
docker-compose up -d
```

4. Generate app keys. Run this step in the initial setup or when the APP_KEY values in the .env files are empty.
```
docker exec -ti payment-service php artisan key:generate
docker container restart payment-service
docker exec -ti payment-app php artisan key:generate
docker container restart payment-app
```
5. Install other dependencies and run migrations
```
docker exec -it payment-service sh ./install.sh
```

## Testing
```
docker exec -it payment-service ./vendor/bin/pest
```

## Services
Payment App - http://localhost:8077/
Payment Service - http://localhost:8070/

## Helper
Adminer - http://localhost:8083/
