#!/bin/bash
set -e

MARKER_FILE="/var/www/html/.installed"
INSTALL_SCRIPT="/var/www/html/install.sh"
CONFIG_FILE="/etc/frankenphp.json"

# Check if app needs installation
if [ ! -f "$MARKER_FILE" ]; then
    echo "Running first-time installation..."

    if [ -x "$INSTALL_SCRIPT" ]; then
        "$INSTALL_SCRIPT"
    else
        echo "Error: $INSTALL_SCRIPT not found or not executable." >&2
        exit 1
    fi

    touch "$MARKER_FILE"
fi

# Start FrankenPHP
exec /usr/local/bin/frankenphp run --config "$CONFIG_FILE"
