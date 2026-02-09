# Stage 1: PHP + Composer
FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git curl \
    supervisor nginx \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www/html

# Copy composer binary from official composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy your nginx.conf
COPY .fly/nginx/nginx.conf /etc/nginx/nginx.conf

# Copy Supervisor configuration
COPY .fly/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose HTTP port
EXPOSE 80

# Start Supervisor (manages Nginx + PHP-FPM)
CMD ["/usr/bin/supervisord", "-n"]
