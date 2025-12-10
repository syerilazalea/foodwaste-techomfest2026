FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev \
    nginx supervisor \
    && docker-php-ext-install pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Hapus default config bawaan nginx (penting!)
RUN rm -f /etc/nginx/conf.d/default.conf

# Copy config kamu
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

COPY supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache

ENV PORT=8080

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
