FROM php:8.2-alpine

# Install Package
RUN apk update && apk add --no-cache \
    libpq-dev \
    git curl zip unzip \
    && docker-php-ext-install pdo_pgsql pgsql \

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

#Install Frankenphp
RUN curl https://frankenphp.dev/install.sh | sh
mv frankenphp /usr/local/bin/
    
# Set user (if needed)
USER root

# Copy entrypoint script
COPY deploy/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Copy FrankenPHP configuration
COPY deploy/frankenphp.json /etc/frankenphp.json
RUN chmod +x /etc/frankenphp.json

# Set working directory
WORKDIR /var/www/html

# Copy application source
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod +x install.sh \
    && chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Run entrypoint on container start
CMD ["/entrypoint.sh"]
