FROM php:7.3-apache
USER root
COPY . /var/www/html/
RUN chmod -R 777 /var/www/html/data
RUN whoami
EXPOSE 80