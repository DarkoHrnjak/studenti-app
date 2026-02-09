# Dockerfile (use PHP 8.4)
FROM php:8.4-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
 && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd xml

# get composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# allow composer to run as root in container
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
