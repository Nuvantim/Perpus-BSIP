FROM php:8.2-cli-alpine

# Install dependencies & PHP extensions
RUN apk add --no-cache --update git curl zip unzip postgresql-dev \
    libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev oniguruma-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath gd && \
    rm -rf /var/cache/apk/*


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Install FrankenPHP
RUN curl -L https://github.com/dunglas/frankenphp/releases/download/v1.2.1/frankenphp-linux-x86_64 -o frankenphp && \
chmod +x frankenphp && \
mv frankenphp /usr/local/bin

# Set user (optional)
USER root

# Copy entrypoint script
COPY deploy/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Set working directory
WORKDIR /var/www/html

# Copy application source
COPY . .

# Set permissions
RUN chmod +x /var/www/html/install.sh
RUN chmod -R 775 /var/www/html/
RUN chmod -R 777 /var/www/html/public /var/www/html/storage

# Start entrypoint
EXPOSE 8000
CMD ["/entrypoint.sh"]
