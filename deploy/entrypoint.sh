#!/bin/sh
set -e

# Configure PHP-FPM to run in non-daemon mode
sed -i 's/;daemonize = yes/daemonize = no/g' /etc/php82/php-fpm.conf

# Check if the application needs to be installed (using a flag file)
if [ ! -f /var/www/html/.installed ]; then
    echo "Running first-time installation..."
    touch /var/www/html/.installed
    sh /var/www/html/install.sh
fi

# Start PHP-FPM in the background
php-fpm82 &

# Start Nginx as the main foreground process
exec nginx -g "daemon off;"
