FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libicu-dev \
    libxml2-dev

# Instalar extensiones PHP necesarias para Laravel
RUN docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd intl

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar archivos del proyecto
WORKDIR /var/www
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Generar cache
RUN php artisan config:cache

# Exponer el puerto de Laravel
EXPOSE 8000

# Comando de inicio
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8000

