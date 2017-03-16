web: vendor/bin/heroku-php-apache2 public/
clock: scripts/clock

premium_worker: php artisan queue:work --queue=high,medium,low --tries=3 --timeout=600
worker: php artisan queue:work --queue=high,medium,low,default,idle --tries=3 --timeout=600
