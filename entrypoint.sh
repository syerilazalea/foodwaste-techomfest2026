#!/bin/bash
set -e

# Pastikan APP_KEY tersedia
if [ -z "$APP_KEY" ]; then
  echo "APP_KEY is missing! Please set it in Railway Environment Variables."
  exit 1
fi

# Pastikan .env ada (gunakan environment variables Railway)
if [ ! -f .env ]; then
  echo "APP_ENV=${APP_ENV:-production}" > .env
  echo "APP_KEY=${APP_KEY}" >> .env
  echo "APP_DEBUG=${APP_DEBUG:-false}" >> .env
  echo "DB_CONNECTION=mysql" >> .env
  echo "DB_HOST=${DB_HOST}" >> .env
  echo "DB_PORT=${DB_PORT}" >> .env
  echo "DB_DATABASE=${DB_DATABASE}" >> .env
  echo "DB_USERNAME=${DB_USERNAME}" >> .env
  echo "DB_PASSWORD=${DB_PASSWORD}" >> .env
fi

# Optional: migrate database
php artisan migrate --force

# Jalankan Octane dengan 1 worker agar stabil di Railway
exec php artisan octane:start --server=swoole --host=0.0.0.0 --port=${PORT:-8080} --workers=1 --task-workers=1
