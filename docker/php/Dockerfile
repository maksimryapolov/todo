FROM php:8.1-fpm-alpine

# Устанавливаем системные зависимости
RUN apk update && apk add \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip

# Устанавливаем PHP расширения
RUN docker-php-ext-install \
    pdo_mysql \
    mysqli \
    gd \
    soap

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Настройки PHP
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/html