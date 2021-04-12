FROM php:8-cli

# Install php core extensions
RUN apt-get update && apt-get install -y acl build-essential curl git jpegoptim libz-dev optipng pngquant software-properties-common unzip zip libgmp-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev libicu-dev libedit-dev libreadline-dev libxml2-dev zlib1g-dev libjpeg-dev libonig-dev \
    && ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/ \
    && docker-php-ext-configure gmp \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j "$(nproc)" bcmath exif gd gmp intl json mbstring mysqli pdo pdo_mysql readline xml zip pcntl

# Install redis
RUN pecl install redis \
    && docker-php-ext-enable redis

# Install composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Install sqlite3 for testing
RUN apt-get install -y sqlite3

# Clear
RUN apt-get clean

WORKDIR /var/www/html
