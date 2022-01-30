FROM php:8.1-apache
RUN apt update && apt install libpq-dev -y
RUN docker-php-ext-install pdo pdo_pgsql pgsql