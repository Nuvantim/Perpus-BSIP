FROM php:8.4.6-zts-alpine3.20

# Install dependencies & PHP extensions
RUN apk update && apk add --no-cache \
    postgresql-dev git curl zip unzip \
    && docker-php-ext-install pdo_pgsql pgsql \
    && apk del postgresql-dev \
    && rm -rf /var/cache/apk/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Install FrankenPHP
RUN curl -fsSL https://frankenphp.dev/install.sh | sh && \
    mv frankenphp /usr/local/bin/

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
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod +x install.sh || true \
    && chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Start entrypoint
EXPOSE 8989
CMD ["/entrypoint.sh"]
