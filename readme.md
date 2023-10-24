# backend
## Project setup
```
docker-compose up --build
```

## Bash into docker image
```
docker exec -it <app image name> bash
```

## Run migrations and seed db
```
php artisan migrate --seed
```

## Install Laravel Passport
```
php artisan passport:install
```

# frontend

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Run your unit tests
```
npm run test:unit
```

### Lints and fixes files
```
npm run lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).
