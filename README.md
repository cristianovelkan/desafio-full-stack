# Building the Docker image
### 1. Build and bring up the containers:

`docker compose -f docker/docker-compose.yml --env-file ./.env up --build`

### 2. Run Laravel migrations:

`docker exec -t laravelapp php artisan migrate`
