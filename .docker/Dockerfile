FROM php:7-fpm
RUN apt update \
    && apt install -y zlib1g-dev libzip-dev iputils-ping nodejs npm unzip zlib1g-dev libicu-dev g++
RUN docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install curl \
    && docker-php-ext-install intl

WORKDIR /code

