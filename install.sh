#!/bin/bash

# Set environment file
mv .env.prod .env && \

# Install production dependencies only
composer install --no-dev --optimize-autoloader && \

# Generate application key first
php artisan key:generate && \

# Then clear and rebuild Laravel caches
php artisan optimize:clear && \
php artisan config:cache && \
php artisan event:cache && \
php artisan route:cache && \
php artisan view:cache && \

# Final application setup 
php artisan storage:link
