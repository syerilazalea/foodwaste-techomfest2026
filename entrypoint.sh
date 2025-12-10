#!/bin/bash
set -e

# ============================
# Railway: Make sure APP_KEY exists
# ============================
if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set. Railway environment variable APP_KEY must be defined."
    exit 1
fi

# Copy .env.example if .env does not exist
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Copied .env.example to .env"
fi

# Replace APP_KEY in .env with Railway env
sed -i "s|^APP_KEY=.*|APP_KEY=${APP_KEY}|" .env
echo "Set APP_KEY from Railway env"

# Start Octane with 1 worker
php artisan octane:start --server=swoole --host=0.0.0.0 --port=${PORT} --workers=1 --task-workers=1
