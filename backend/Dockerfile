FROM php:8.2-fpm

# Установка зависимостей для pdo_pgsql и других необходимых расширений
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-install fileinfo

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Копируем наш кастомный php.ini в контейнер
COPY php.ini /usr/local/etc/php/

# Копирование файлов для установки зависимостей
COPY composer.json composer.lock ./

# Установка зависимостей Laravel
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --ignore-platform-reqs --no-scripts --no-autoloader

# Копирование остальных файлов проекта
COPY . .

# Настройка прав доступа только для необходимых директорий
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache 
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
