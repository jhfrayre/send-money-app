FROM php:8.1.19-fpm-alpine3.16

# Install dependencies
RUN apk update && apk add --no-cache \
    bash \
    git \
    vim nano \
    util-linux

# Install Laravel prerequisites
RUN apk add --no-cache zlib-dev libzip-dev
RUN docker-php-ext-install pdo_mysql zip

COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./www.conf /usr/local/etc/php-fpm.d/www.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.5.7
RUN composer --version

WORKDIR /var/www/html
COPY ./src /var/www/html
RUN composer install --prefer-dist

ENTRYPOINT php artisan serve --host=0.0.0.0 --port=9001
