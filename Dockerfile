# FROM php:8.2-apache

# RUN docker-php-ext-install mysqli

# COPY site/ /var/www/html/

# RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf


FROM php:8.2-apache

RUN apt-get update && apt-get install -y git

RUN docker-php-ext-install mysqli

RUN rm -rf /var/www/html/* && \
    git clone https://github.com/MohammedJomaa66/project_unix.git /tmp/app && \
    cp -r /tmp/app/site/* /var/www/html/ && \
    rm -rf /tmp/app

RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf