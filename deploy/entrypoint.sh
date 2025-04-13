#!/bin/sh
set -e

# Memeriksa apakah aplikasi perlu diinstal (menggunakan file penanda)
if [ ! -f /var/www/html/.installed ]; then
    echo "Menjalankan instalasi pertama kali..."
    touch /var/www/html/.installed
    sh /var/www/html/install.sh
fi

# Memulai FrankenPHP
exec /usr/local/bin/frankenphp run --config /etc/frankenphp.json
