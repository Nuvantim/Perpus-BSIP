FROM php:8.2-cli-bookworm

# Install dependencies & PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends git curl zip unzip postgresql-server-dev-all \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libonig-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath gd && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Install FrankenPHP
RUN curl -L https://github.com/dunglas/frankenphp/releases/download/v1.2.3/frankenphp-linux-x86_64 -o frankenphp && \
chmod +x frankenphp && \
mv frankenphp /usr/local/bin

# Set user (optional)
USER root

# Copy entrypoint script
COPY deploy/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Set working directory
WORKDIR /app

# Copy application source
COPY . .

# Set permissions
RUN chmod +x /app/install.sh
RUN chmod -R 775 /app
RUN chmod -R 777 /app/public /app/storage

CMD ["/entrypoint.sh"]
