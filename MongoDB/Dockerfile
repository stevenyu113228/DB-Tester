FROM php:8.0-apache
RUN apt update && apt install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN pecl install mongodb && docker-php-ext-enable mongodb

