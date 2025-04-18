FROM nginx:1.26.3-alpine3.20

# Install dependencies & PHP extensions
RUN apk update && apk upgrade && \
    apk add curl git unzip php82 php82-fpm php82-pdo php82-pdo_pgsql php82-openssl php82-mbstring php82-tokenizer php82-json php82-fileinfo php82-ctype php82-curl php82-phar php82-session php82-dom php82-xml php82-xmlwriter openrc && \
    rm -rf /var/cache/apk/*

# Create openrc
RUN mkdir -p /run/openrc
RUN touch /run/openrc/softlevel

# Symbolic link php
RUN ln -s /usr/bin/php82 /usr/bin/php

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Set user (optional)
USER root

# Copy entrypoint script
COPY deploy/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

#Copy Nginx Configuration
# COPY deploy/nginx.conf /etc/nginx/nginx.conf
COPY deploy/default.conf /etc/nginx/conf.d/default.conf

# Set working directory
RUN mkdir -p /var/www/html
WORKDIR /var/www/html

# Copy application source
COPY . .

# Set permissions
RUN adduser -D -u 1000 -G www-data www-data
RUN chown -R www-data.www-data /var/www/html
RUN chmod +x /var/www/html/install.sh
RUN chmod -R 777 /var/www/html/storage
RUN chmod -R 777 /var/www/html/bootstrap/cache

CMD ["/entrypoint.sh"]
