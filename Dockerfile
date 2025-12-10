FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev \
    nginx supervisor gettext-base curl \
    && docker-php-ext-install pdo_mysql zip

# Install Node.js (untuk Vite build)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Set working directory
WORKDIR /var/www/html

# Copy project BEFORE npm install
COPY . .

# Install frontend dependencies
RUN npm install

# Build frontend assets
RUN npm run build

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Remove default nginx config
RUN rm -f /etc/nginx/conf.d/default.conf

# Copy nginx template config
COPY nginx/default.conf.template /etc/nginx/conf.d/default.conf.template

# Copy supervisor config
COPY supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Clear caches
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

# Storage link
RUN php artisan storage:link || true

# Railway will inject PORT
ENV PORT=8080
EXPOSE 8080

# Start supervisor (PHP-FPM + Nginx)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
