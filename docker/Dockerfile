FROM php:apache

COPY ./app/public/views /var/www/html

EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]