#!/bin/sh
set -e

# Memeriksa apakah aplikasi perlu diinstal (menggunakan file penanda)
if [ ! -f /var/www/html/.installed ]; then
    echo "Menjalankan instalasi pertama kali..."
    touch /app/.installed
    sh /app/install.sh
fi
