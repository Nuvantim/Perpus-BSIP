#!/bin/sh
set -e

# Memeriksa apakah aplikasi perlu diinstal (menggunakan file penanda)
if [ ! -f /var/www/html/.installed ]; then
    echo "Menjalankan instalasi pertama kali..."
    sh /var/www/html/install.sh
    touch /var/www/html/.installed
fi

# Memulai FrankenPHP
exec frankenphp run --config /etc/frankenphp.json
