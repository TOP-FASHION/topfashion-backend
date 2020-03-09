FROM wordpress:5.2.4-php7.3-fpm

WORKDIR /var/www/html

COPY wordpress/wp-config.php  /usr/src/wordpress

# COPY locally updated plugins & themes to the new image
COPY wordpress/wp-content/plugins/  /usr/src/wordpress/wp-content/plugins/
COPY wordpress/wp-content/themes/  /usr/src/wordpress/wp-content/themes/
COPY wordpress/wp-content/uploads/  /usr/src/wordpress/wp-content/uploads/

RUN chown -R www-data:www-data /usr/src/wordpress
