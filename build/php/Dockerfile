FROM php:8.2-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && apt-get install -y libmcrypt-dev \
    libmagickwand-dev --no-install-recommends \
    git \
    && pecl install imagick \
    && docker-php-ext-enable imagick

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer