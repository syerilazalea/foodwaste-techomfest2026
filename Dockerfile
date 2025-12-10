# ===========================
# Dockerfile Laravel + Octane
# ===========================

# Base image PHP CLI
FROM php:8.2-cli

# ---------------------------
# Install system dependencies
# ---------------------------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libssl-dev \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libpng-dev \
    libbrotli-dev \
    pkg-config \
    nodejs \
    npm \
    procps \
    && docker-php-ext-install pdo pdo_mysql zip pcntl

# ---------------------------
# Install Swoole for Octane
# ---------------------------
RUN pecl install swoole \
    && docker-php-ext-enable swoole

# ---------------------------
# Copy Composer from official image
# ---------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ---------------------------
# Set working directory
# ---------------------------
WORKDIR /var/www

# ---------------------------
# Copy project files
# ---------------------------
COPY . .

# ---------------------------
# Install PHP dependencies
# ---------------------------
RUN composer install --no-dev --optimize-autoloader

# ---------------------------
# Install Node dependencies (optional)
# ---------------------------
RUN npm install
RUN npm run build

# ---------------------------
# Railway auto PORT
# ---------------------------
ENV PORT=8080
EXPOSE 8080

# ---------------------------
# Entrypoint
# ---------------------------
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
