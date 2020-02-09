## https://github.com/docker-library/wordpress
FROM wordpress:5.2.4-php7.2-apache

## PHP extensions
## update and uncomment this next line as needed
# RUN docker-php-ext-install pdo pdo_mysql

## custom directories and files
## copy them here instead of volume
## /var/www/html/
## wordpress docker-entrypoint.sh runs
## chown -R www-data:www-data /usr/src/wordpress

COPY . /var/www/html
COPY . /var/www/html/wp-content/plugins/better-rest-api-featured-images/

COPY ./wordpress/wp-content/plugins/better-rest-api-featured-images /var/www/html/wp-content/plugins/better-rest-api-featured-images/
