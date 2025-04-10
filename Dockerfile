FROM php:8.1-fpm

# Install system dependencies dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    git curl libpq-dev zip unzip libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy dependency-related files dulu untuk cache layer
COPY composer.json composer.lock ./

# Install dependencies (tanpa dev, untuk production)
RUN composer install --no-dev --optimize-autoloader

# Salin seluruh project Laravel
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Copy entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["/entrypoint.sh"]

