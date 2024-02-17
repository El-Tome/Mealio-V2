FROM php:7.4-apache

COPY ./app/public/views /var/www/html

EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]