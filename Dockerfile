FROM dunglas/frankenphp:php8.2-alpine

# Install dependencies using apk (Alpine's package manager)
RUN apk update && apk add --no-cache \
    # PHP 8.2 Core
    php82 php82-cli \
    # Database (PostgreSQL)
    php82-pdo php82-pdo_pgsql php82-pgsql \
    # Common PHP Extensions
    php82-mbstring php82-openssl php82-curl \
    php82-xml php82-dom php82-simplexml php82-xmlwriter php82-xmlreader \
    php82-tokenizer php82-fileinfo php82-session php82-ctype php82-json \
    # ZIP & Compression
    php82-zip zip unzip \
    # Dev Tools
    git curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer
    
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
