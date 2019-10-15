## https://github.com/docker-library/wordpress
FROM wordpress:4.9.6-php7.2-apache

## PHP extensions
## update and uncomment this next line as needed
# RUN docker-php-ext-install pdo pdo_mysql

## custom directories and files
## copy them here instead of volume
## /var/www/html/
## wordpress docker-entrypoint.sh runs
## chown -R www-data:www-data /usr/src/wordpress
COPY ./build/ /usr/src/wordpress/
