#!/bin/sh
# RUN component dev
composer install && \
php artisan blueprint:build && \
rm -rf /var/www/html/vendor && \

# Run component deploy
composer install --no-dev --optimize-autoloader && \
php artisan migrate --seed --force && \

# Remove cache
php artisan config:cache && \
php artisan event:cache && \
php artisan route:cache && \
php artisan view:cache && \

# Final configuration 
php artisan storage:link && \
php artisan key:generate && \

# run Frankenphp in background
frankenphp --config=/etc/frankenphp.json
