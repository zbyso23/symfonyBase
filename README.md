# symfonyBase

Symfony 7 project base on Docker stack with PHP 8.3, Postgres and Nginx with PHPUnit example test.

## Install
```
docker-compose up --build -d
```

After started you can check in browser on `http://localhost:8000`

### Orders for testing
In browser:
Create Order: `http://localhost:8080/order/create` 
List Orders: `http://localhost:8080/order/list`

## Tests PHPUnit
```
docker-compose exec php bash
```
```
vendor/bin/phpunit
```

## Migration
```
docker-compose exec php bash
```
```
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

## Clear Doctrine cache
```
docker-compose exec php bash
```
```
php bin/console cache:clear
```


## Check Doctrine Entities
```
docker-compose exec php bash
```
```
php bin/console doctrine:mapping:info
```