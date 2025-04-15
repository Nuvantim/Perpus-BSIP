FROM php:8.2-cli-alpine

# Install dependencies & PHP extensions
RUN apk add --no-cache --virtual .build-deps \
    postgresql-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    && \
    apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    postgresql-client \
    && \
    docker-php-ext-configure gd --with-freetype --with-jpeg \
    && \
    docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_pgsql \
    mbstring \
    zip \
    exif \
    pcntl \
    bcmath \
    gd \
    && \
    apk del --no-network .build-deps \
    && \
    rm -rf /tmp/* /var/cache/*

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
&& find /var/www/html -type d -exec chmod 755 {} \; \
&& find /var/www/html -type f -exec chmod 644 {} \; \
&& chmod +x install.sh 2 >/dev/null || true \
&& chmod -R 775 /var/www/html/storage \
&& chmod -R 775 /var/www/html/bootstrap/cache

# Start entrypoint
EXPOSE 8989
CMD ["/entrypoint.sh"]
