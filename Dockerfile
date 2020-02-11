## https://github.com/docker-library/wordpress
FROM wordpress:5.2.4-php7.2-apache

WORKDIR /var/www/html

COPY wp-config.php  /usr/src/wordpress

# COPY locally updated plugins & themes to the new image for redployment to Cloud RUN
COPY wordpress/wp-content/plugins/  /usr/src/wordpress/wp-content/plugins/
COPY wordpress/wp-content/themes/  /usr/src/wordpress/wp-content/themes/

RUN chown -R www-data:www-data /usr/src/wordpress