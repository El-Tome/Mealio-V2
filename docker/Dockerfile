FROM php:apache

RUN docker-php-ext-install pdo_mysql

COPY ./app/public/views /var/www/html

EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]