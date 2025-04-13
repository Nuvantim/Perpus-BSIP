#!/bin/sh
set -e

# Check if app needs installation (you can use a marker file)
if [ ! -f /var/www/html/.installed ]; then
    echo "Running first-time installation..."
    sh /var/www/html/install.sh
    touch /var/www/html/.installed
fi

# Start FrankenPHP
exec frankenphp run --config /etc/frankenphp.json
