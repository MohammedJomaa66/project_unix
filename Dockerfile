# FROM php:8.2-apache

# RUN docker-php-ext-install mysqli

# COPY site/ /var/www/html/

# RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf


FROM php:8.2-apache

# 1. Install git (and zip/unzip which composer/git often need)
RUN apt-get update && apt-get install -y git

# 2. Install your PHP extension
RUN docker-php-ext-install mysqli

# 3. Clone your GitHub repo directly into the web root
# (We clear the directory first because git clone expects an empty folder)
RUN rm -rf /var/www/html/* && \
    git clone https://github.com/MohammedJomaa66/project_unix.git /tmp/app && \
    cp -r /tmp/app/site/* /var/www/html/ && \
    rm -rf /tmp/app

RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf