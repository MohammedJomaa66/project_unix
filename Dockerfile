
FROM php:8.2-apache
RUN docker-php-ext-install mysqli


COPY ./site/index.php .
EXPOSE 80
