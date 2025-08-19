#!/bin/bash

# Run composer to install all dependencies
composer install && \

# Build Laravel blueprint components
php artisan blueprint:build && \

# Remove existing vendor directory
rm -rf /var/www/html/vendor && \

# Install production dependencies only
composer install --no-dev --optimize-autoloader && \

# Migrate database
php artisan migrate:fresh --seed --force && \

# Generate application key first
php artisan key:generate && \

# Then clear and rebuild Laravel caches
php artisan config:cache && \
php artisan event:cache && \
php artisan route:cache && \
php artisan view:cache && \

# Final application setup 
php artisan storage:link
