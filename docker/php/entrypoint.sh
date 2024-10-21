#!/bin/bash

cp .env.dev .env
composer install
php artisan key:generate
php artisan config:cache
php artisan migrate:refresh --seed

php artisan forecast:hourly-daily

chmod 777 -R .

service nginx restart
php-fpm
