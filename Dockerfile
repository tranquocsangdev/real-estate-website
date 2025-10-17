FROM php:8.3-fpm

# Cài dependencies PHP
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip sockets

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Làm việc tại thư mục ứng dụng
WORKDIR /var/www/html

# Copy toàn bộ mã nguồn
COPY . .

# Thiết lập biến môi trường Laravel tối thiểu để tránh lỗi khi build
ENV APP_ENV=production
ENV APP_KEY=base64:Cf27CglvzSJD1l2GRBAtrbpwfW7NQDs6S8sRk8e2Eu4=
ENV CACHE_DRIVER=file
ENV SESSION_DRIVER=file
ENV QUEUE_CONNECTION=sync

# ✅ Không chạy script của composer để tránh artisan lỗi vì thiếu env
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Phân quyền
RUN chmod -R 777 storage bootstrap/cache

# Xóa cache cũ nếu có
RUN php -r "file_exists('bootstrap/cache/config.php') && unlink('bootstrap/cache/config.php');"

# Mở cổng 8000
EXPOSE 8000

# Chạy server Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
