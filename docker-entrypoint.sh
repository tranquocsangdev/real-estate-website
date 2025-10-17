#!/bin/bash
set -e

# Chờ PostgreSQL sẵn sàng (tránh lỗi connect refused)
echo "⏳ Đang chờ PostgreSQL khởi động..."
until php -r "try { new PDO('pgsql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE') . ';sslmode=require', getenv('DB_USERNAME'), getenv('DB_PASSWORD')); echo '✅ PostgreSQL ready'; } catch (Exception \$e) { echo '.'; sleep(2); }"; do :; done

# Clear và cache config
php artisan config:clear
php artisan cache:clear
php artisan config:cache

# Chạy migrate và seed
php artisan migrate --force
php artisan db:seed --force || true

# Chạy queue và server song song
php artisan queue:work &
php artisan reverb:start &

# Cuối cùng, khởi động server Laravel
php artisan serve --host=0.0.0.0 --port=8000
