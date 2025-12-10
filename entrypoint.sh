#!/bin/bash
set -e

# Copy .env.example jika .env belum ada
if [ ! -f /var/www/.env ]; then
    cp /var/www/.env.example /var/www/.env
fi

# Generate APP_KEY jika belum ada
php artisan key:generate --force

# Jalankan Octane
php artisan octane:start --server=swoole --host=0.0.0.0 --port=${PORT}
