FROM php:8.1-cli-buster

ARG XDEBUG_VERSION=3.1.6

RUN apt update &&\
    apt install --yes mariadb-client locales libpng-dev libjpeg62-turbo-dev libonig-dev libicu-dev git libzip-dev libmemcached-dev &&\
    echo "en_US.UTF-8 UTF-8" >> /etc/locale.gen &&\
    locale-gen -a &&\
    update-locale LANG=en_US.UTF-8 &&\
    docker-php-ext-install -j$(nproc) pdo_mysql mysqli gd iconv mbstring intl zip &&\
    pecl install memcached && docker-php-ext-enable memcached &&\
    pecl install xdebug-$XDEBUG_VERSION && docker-php-ext-enable xdebug &&\
    rm -rf /var/cache/apk/*

# install composer
ENV COMPOSER_HOME /composer
ENV COMPOSER_CACHE_DIR /composer-cache
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

USER www-data

# Set up the volumes and working directory
VOLUME ["/app"]
WORKDIR /app