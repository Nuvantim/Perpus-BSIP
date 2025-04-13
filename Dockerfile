FROM dunglas/frankenphp:1.5-php8.2.28-alpine
FROM php:8.2.28-cli-alpine3.21

# Install dependencies using apk (Alpine's package manager)
RUN apk update && apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    postgresql-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Set Working Directory
WORKDIR /var/www/html

# Copy app code
COPY . .

# Set permission folder
RUN chown -R www-data:www-data /var/www/html

# Set permission public folder
RUN chmod -R 755 /var/www/html
RUN chmod -R 777 /var/www/html/storage

# Copy entrypoint
COPY deploy/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Copy Frankenphp configuration
COPY deploy/frankenphp.json /etc/frankenphp.json
RUN chmod +x /etc/frankenphp.json

# Set root access
USER root

RUN composer install && \
    php artisan blueprint:build && \
    rm -rf /var/www/html/vendor && \
    # Run component deploy
    composer install --no-dev --optimize-autoloader && \
    php artisan migrate:fresh --seed --force && \
    # Remove cache
    php artisan config:cache && \
    php artisan event:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    # Final configuration 
    php artisan storage:link && \
    php artisan key:generate

CMD ["/entrypoint.sh"]
