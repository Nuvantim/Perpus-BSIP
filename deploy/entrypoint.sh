#!/bin/sh
set -e

# Configure PHP-FPM to run in non-daemon mode
sed -i 's/;daemonize = yes/daemonize = no/g' /etc/php82/php-fpm.conf

# Memeriksa apakah aplikasi perlu diinstal (menggunakan file penanda)
if [ ! -f /var/www/html/.installed ]; then
    echo "Menjalankan instalasi pertama kali..."
    touch /var/www/html/.installed
    sh /var/www/html/install.sh
fi

# Start PHP-FPM in background
php-fpm82 &

# Start Nginx in foreground
nginx -g "daemon off;"
