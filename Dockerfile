FROM php:8.3-cli

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    mariadb-client \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Установка рабочей директории
WORKDIR /var/www

# Копирование файлов
COPY . .

RUN apt-get update && apt-get install -y openssl ca-certificates

# Установка зависимостей Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Установка прав
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/storage

# Expose порт Laravel (если нужен artisan serve)
EXPOSE 8000

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000
