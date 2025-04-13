#!/bin/sh
set -e

# Memeriksa apakah aplikasi perlu diinstal (menggunakan file penanda)
if [ ! -f /var/www/html/.installed ]; then
    echo "Menjalankan instalasi pertama kali..."
    touch /var/www/html/.installed
    
    apk update && apk add --no-cache \
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

    echo "extension=pdo_pgsql" >> /etc/php82/php.ini \
    && echo "extension=pgsql" >> /etc/php82/php.ini

    
    sh /var/www/html/install.sh
fi

# Memulai FrankenPHP
exec /usr/local/bin/frankenphp run --config /etc/frankenphp.json
