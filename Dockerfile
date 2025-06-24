# Gunakan image PHP 8.3 dengan FPM
FROM php:8.3-fpm

# Install ekstensi Laravel, Intl, dan alat bantu lainnya
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev zip \
    libzip-dev libpq-dev libcurl4-openssl-dev libicu-dev \
    nodejs npm \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Install Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Atur direktori kerja di dalam container
WORKDIR /var/www/html

# Salin semua file dari host ke dalam container
COPY . .

# Install dependency Laravel dan build frontend
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Jalankan Laravel menggunakan built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
