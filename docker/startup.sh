#!/bin/bash

# Set default port if not set
export PORT=${PORT:-8080}

# Replace variables in nginx config
# We use envsubst to replace only $PORT, preserving other Nginx variables
envsubst '$PORT' < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf

# Run migrations
# echo "Running migrations..."
# php artisan migrate --force

# Cache configuration
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Start php-fpm
echo "Starting PHP-FPM..."
php-fpm -D

# Start nginx
echo "Starting Nginx..."
nginx -g 'daemon off;'
