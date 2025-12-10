#!/bin/bash
set -e

# ============================
# Copy example env if .env not exist
# ============================
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Copied .env.example to .env"
fi

# ============================
# Generate APP_KEY if not exists
# ============================
if ! grep -q APP_KEY=. .env; then
    php artisan key:generate --ansi
    echo "Generated APP_KEY"
fi

# ============================
# Start Octane with 1 worker
# ============================
php artisan octane:start --server=swoole --host=0.0.0.0 --port=${PORT} --workers=1 --task-workers=1
