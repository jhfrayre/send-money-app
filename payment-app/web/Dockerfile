FROM php:8.1.19-fpm-alpine3.16

# Install dependencies
RUN apk update && apk add --no-cache \
    bash \
    git \
    vim nano
# Install prereqs for installing Laravel requirements
RUN apk add --no-cache \
    zlib-dev libzip-dev \
    nodejs npm nghttp2-dev

RUN docker-php-ext-install pdo_mysql zip

RUN echo 'php_admin_flag[log_errors] = on' >> /usr/local/etc/php-fpm.d/www.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.5.7
RUN composer --version

WORKDIR /var/www/html
COPY ./src /var/www/html
RUN composer install --prefer-dist

RUN npm install
RUN npm run

CMD sh startup.sh
