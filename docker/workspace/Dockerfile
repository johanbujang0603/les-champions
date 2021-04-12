FROM php:8-cli

# Install php core extensions
RUN apt-get update && apt-get install -y acl build-essential git jpegoptim libz-dev optipng pngquant software-properties-common unzip zip libgmp-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev libicu-dev libedit-dev libreadline-dev libxml2-dev zlib1g-dev libjpeg-dev libonig-dev \
    && ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/ \
    && docker-php-ext-configure gmp \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j "$(nproc)" bcmath exif gd gmp intl mysqli pdo pdo_mysql zip pcntl

# Install redis
RUN pecl install redis \
    && docker-php-ext-enable redis

# Install composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Package needed to install node
RUN apt-get update && apt-get install -y gnupg2 curl
RUN curl -sL https://deb.nodesource.com/setup_15.x | bash -
RUN apt-get update && apt-get install -y nodejs

# Install ffmpeg
RUN apt-get install -y ffmpeg

# Create the main user
ARG WWW_USER_ID
ENV WWW_UID=${WWW_USER_ID:-1000}
RUN useradd -ms /bin/bash -u ${WWW_UID} app

WORKDIR /var/www/html

EXPOSE 3000 3001
