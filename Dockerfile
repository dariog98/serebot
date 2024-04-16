FROM php:7.3-apache
COPY . /var/www/html/
RUN chmod -R 777 /var/www/html
EXPOSE 80