FROM php:8.2-fpm

RUN apt-get update
RUN apt-get install -y  \
    curl  \
    wget  \
    git  \
    libffi-dev  \
    libcurl4-openssl-dev  \
    openssl  \
    libssl-dev  \
    libz-dev  \
    libjpeg62-turbo-dev  \
    libfreetype6-dev  \
    libmcrypt-dev  \
    libonig-dev  \
    libpq-dev  \
    libpng-dev  \
    zlib1g-dev  \
    libzip-dev  \
    libmemcached-tools  \
    libzip-dev \
    zlib1g \
    libmemcached-dev \
    bzip2

RUN docker-php-ext-install mbstring && docker-php-ext-configure mbstring
RUN docker-php-ext-install zip && docker-php-ext-configure zip
RUN docker-php-ext-install curl && docker-php-ext-configure curl
RUN docker-php-ext-install shmop && docker-php-ext-configure shmop
RUN docker-php-ext-install gettext && docker-php-ext-configure gettext
RUN docker-php-ext-install fileinfo && docker-php-ext-configure fileinfo
RUN docker-php-ext-install ffi && docker-php-ext-configure ffi
RUN docker-php-ext-install bcmath

RUN git clone -b master https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached \
    && docker-php-ext-configure /usr/src/php/ext/memcached \
        --disable-memcached-sasl \
    && docker-php-ext-install /usr/src/php/ext/memcached \
    && rm -rf /usr/src/php/ext/memcached

RUN pecl install xdebug-3.2.0
ENV XDEBUG_EXT zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20190902/xdebug.so
RUN alias php_xdebug="php -d$XDEBUG_EXT vendor/bin/phpunit"

