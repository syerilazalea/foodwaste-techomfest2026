FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev \
    nginx supervisor gettext-base \
    && docker-php-ext-install pdo_mysql zip

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set workdir
WORKDIR /var/www/html

# Copy project
COPY . .

# Remove default nginx config
RUN rm -f /etc/nginx/conf.d/default.conf

# Copy nginx template config (with ${PORT})
COPY nginx/default.conf.template /etc/nginx/conf.d/default.conf.template

# Copy supervisor config
COPY supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

RUN php artisan config:clear
RUN php artisan route:clear
RUN php artisan view:clear

RUN php artisan storage:link || true

# Railway provides PORT env automatically
ENV PORT=8080
EXPOSE 8080

# Start supervisor (which starts php-fpm and nginx)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
