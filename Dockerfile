FROM php:8.3-zts-bookworm

# Install dependencies & PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev git curl zip unzip \
    && docker-php-ext-install pdo_pgsql pgsql \
    && apt-get purge -y --auto-remove libpq-dev \
    && rm -rf /var/lib/apt/lists/*

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
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod +x install.sh || true \
    && chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Start entrypoint
EXPOSE 8989
CMD ["/entrypoint.sh"]
