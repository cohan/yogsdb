web: vendor/bin/heroku-php-apache2 public/
worker: php artisan queue:work --queue=high,medium,low,default,idle --tries=3 --timeout=600
clock: scripts/clock
