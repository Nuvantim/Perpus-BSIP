#!/bin/bash

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
