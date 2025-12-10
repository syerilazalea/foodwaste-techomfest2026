FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libssl-dev \
    libzip-dev \
    libpq-dev \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip pcntl

# Install Swoole for Octane
RUN pecl install swoole \
    && docker-php-ext-enable swoole

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Working directory
WORKDIR /app

# Copy project
COPY . .

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Railway auto injects PORT
ENV PORT=8080

EXPOSE 8080

CMD php artisan octane:start --server=swoole --host=0.0.0.0 --port=${PORT}
