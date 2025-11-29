FROM php:8.2-apache

# PHP kengaytmalarini o‘rnatamiz
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Fayllarni serverga nusxalash
COPY . /var/www/html/

EXPOSE 80
