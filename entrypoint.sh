#!/bin/bash
set -e

# ============================
# Pastikan APP_KEY ada
# ============================
if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set. Railway environment variable APP_KEY must be defined."
    exit 1
fi

# ============================
# Optional: migrate database
# ============================
php artisan migrate --force

# ============================
# Jalankan Octane
# ============================
exec php artisan octane:start --server=swoole --host=0.0.0.0 --port=${PORT:-8080} --workers=1 --task-workers=1
