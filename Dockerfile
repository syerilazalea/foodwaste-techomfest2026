FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libssl-dev \
    libzip-dev \
    libpq-dev \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Swoole for Octane
RUN pecl install swoole \
    && docker-php-ext-enable swoole

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install composer deps
RUN composer install --no-dev --optimize-autoloader

# Railway injects PORT automatically
ENV PORT=8080

# Expose port for Railway
EXPOSE 8080

# Start Octane using the Railway PORT
CMD php artisan octane:start --server=swoole --host=0.0.0.0 --port=${PORT}
