# 1️⃣ Base image PHP 8.3 + Composer
FROM php:8.3-fpm

# 2️⃣ Cài đặt các package cần thiết
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip sockets

# 3️⃣ Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4️⃣ Tạo thư mục ứng dụng
WORKDIR /var/www/html

# 5️⃣ Copy toàn bộ mã nguồn
COPY . .

# 6️⃣ Cài dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# 7️⃣ Thiết lập quyền ghi cho storage & bootstrap
RUN chmod -R 777 storage bootstrap/cache

# 8️⃣ Build cache Laravel
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# 9️⃣ Expose cổng 8000 để Render có thể truy cập
EXPOSE 8000

# 10️⃣ Lệnh mặc định khởi chạy server Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
