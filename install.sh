#!/bin/bash

# Run composer to install all dependencies
composer install && \

# Build Laravel blueprint components
php artisan blueprint:build && \

# Remove existing vendor directory
rm -rf /var/www/html/vendor && \

# Install production dependencies only
composer install --no-dev --optimize-autoloader && \

# Fresh migrate and seed the database (force to skip confirmation)
php artisan migrate:fresh --seed --force && \

# Clear and rebuild Laravel caches
php artisan config:cache && \
php artisan event:cache && \
php artisan route:cache && \
php artisan view:cache && \

# Final application setup
php artisan storage:link && \
php artisan key:generate
