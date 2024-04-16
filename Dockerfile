FROM php:7.3-apache
COPY . /var/www/html/
RUN mkdir /var/www/html/data
RUN chmod -R 777 /var/www/html/data
RUN whoami
EXPOSE 80