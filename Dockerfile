#------------- Setup Environment -------------------------------------------------------------
# Pull base image
FROM ubuntu:16.04

# Install common tools
RUN apt-get update
RUN apt-get install -y wget curl nano htop git unzip bzip2 software-properties-common locales

# Set evn var to enable xterm terminal
ENV TERM=xterm

# Set working directory
WORKDIR /var/www/html

#------------- Application Specific Stuff ----------------------------------------------------
# Install PHP
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt update
RUN apt-get install -y \
    php7.4-fpm \
    php7.4-common \
    php7.4-curl \
    php7.4-mysql \
    php7.4-mbstring \
    php7.4-json \
    php7.4-xml \
    php7.4-bcmath

#------------- FPM & Nginx configuration ----------------------------------------------------
# Config fpm to use TCP instead of unix socket
ADD resources/www.conf /etc/php/7.4/fpm/pool.d/www.conf
RUN mkdir -p /var/run/php

# Install Nginx
RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys ABF5BD827BD9BF62
RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C
RUN echo "deb http://nginx.org/packages/ubuntu/ trusty nginx" >> /etc/apt/sources.list
RUN echo "deb-src http://nginx.org/packages/ubuntu/ trusty nginx" >> /etc/apt/sources.list
RUN apt-get update

RUN apt-get install -y nginx

ADD resources/default /etc/nginx/sites-enabled/
ADD resources/nginx.conf /etc/nginx/

#RUN chown -R www-data:www-data /var/www/html/storage/
#------------- Composer & laravel configuration ----------------------------------------------------
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#------------- Supervisor Process Manager ----------------------------------------------------
# Install supervisor
RUN apt-get install -y supervisor
RUN mkdir -p /var/log/supervisor
ADD resources/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN composer update
#------------- Container Config ---------------------------------------------------------------
# Expose port 80
EXPOSE 8080

# Set supervisor to manage container processes
ENTRYPOINT ["/usr/bin/supervisord"]
