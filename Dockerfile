FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    pkg-config \
    libssl-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    libpq-dev \
    libbrotli-dev \
    libzstd-dev \
    && docker-php-ext-install pdo_mysql zip

# Install Swoole (disable problematic features)
RUN pecl install swoole \
    && docker-php-ext-enable swoole \
    && php -m | grep swoole

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install composer deps
RUN composer install --no-dev --optimize-autoloader

# Railway injects PORT automatically
ENV PORT=8080

# Expose port
EXPOSE 8080

# Start Laravel Octane with Swoole
CMD php artisan octane:start --server=swoole --host=0.0.0.0 --port=${PORT}
