FROM php:8.3-fpm

# Cài dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip sockets

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy mã nguồn
WORKDIR /var/www/html
COPY . .

# Cài đặt composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts
RUN chmod -R 777 storage bootstrap/cache

# Copy entrypoint
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Mở port
EXPOSE 8000

# Chạy script entrypoint
ENTRYPOINT ["docker-entrypoint.sh"]
