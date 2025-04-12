FROM php:8.2-fpm
FROM dunglas/frankenphp:1.5-php8.2.28-alpine

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
mv composer.phar /usr/local/bin/composer

#Set Working Directory
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

# Set working directory
WORKDIR /var/www/html

CMD ["/entrypoint.sh"]

