FROM php:8-fpm

# Install php extensions
RUN apt-get update && apt-get install -y acl build-essential jpegoptim libz-dev optipng pngquant software-properties-common unzip zip libgmp-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev libicu-dev libedit-dev libreadline-dev libxml2-dev zlib1g-dev libjpeg-dev libonig-dev \
    && ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/ \
    && docker-php-ext-configure gmp \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j "$(nproc)" bcmath exif gd gmp intl mysqli pdo pdo_mysql zip pcntl

# Install redis
RUN pecl install redis \
    && docker-php-ext-enable redis

# Define default env variables
ARG WWW_USER_ID
ENV WWW_UID=${WWW_USER_ID:-1000}

# PHP-fpm configuration
COPY ./config/pool.conf /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/user = www-data/user = $WWW_UID/g" /usr/local/etc/php-fpm.d/www.conf

EXPOSE 9000
WORKDIR /var/www/html
RUN chown ${WWW_USER}:www-data /var/www/html