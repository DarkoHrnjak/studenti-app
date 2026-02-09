# Stage 1: PHP + Composer
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies for Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
 && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd xml

# Copy composer from official composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy entrypoint script if you have one
COPY .fly/entrypoint.sh /entrypoint
RUN chmod +x /entrypoint

# Expose port 8080 for Fly.io
EXPOSE 8080

CMD ["/entrypoint"]
