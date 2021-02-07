# Laravel 8 Clean Architecture Example
https://niceprogrammer.com/laravel-8-clean-architecture-example/

To run the project using docker and laravel sail run these commands.
```
cp .env.example .env
docker run --rm -it -v $PWD:/app nickalcala/php74-composer composer install --ignore-platform-reqs
vendor/bin/sail up -d
vendor/bin/sail artisan key:generate
vendor/bin/sail artisan passport:keys
vendor/bin/sail artisan optimize
vendor/bin/sail artisan api:cache
vendor/bin/sail artisan migrate
vendor/bin/sail npm i
vendor/bin/sail npm run prod
vendor/bin/sail artisan swg:scan
```
The application should now be available at http://0.0.0.0/.
> Notes (2021-01-31): PHP 7 is used due to dingo/api:3.0.5 still not compatible with PHP 8.

Swagger documentation can be viewed at http://0.0.0.0/swagger-ui.html.
