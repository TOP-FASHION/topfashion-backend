## https://github.com/docker-library/wordpress
FROM wordpress:5.2.4-php7.2-apache

MAINTAINER EvgeniyPopov 1212evgen@gmail.com

# NOTE:
# Do NOT set WORKDIR as the entrypoint script provided by WordPress
# has assumptions about the working directory when it runs and the
# build will be boken if its set here.

# Setup required build binaries
RUN apt-get update

# Remove the default plugins and themes
RUN rm -rf /usr/src/wordpress/wp-content/plugins/hello.php
RUN rm -rf /usr/src/wordpress/wp-content/themes/*

# WP config
COPY wordpress/wp-config.php /usr/src/wordpress/wp-config.php
COPY --chown=www-data:www-data . /var/www/html
COPY --chown=www-data:www-data wordpress/wp-config.php /var/www/html/wp-config.php

# COPY locally updated plugins & themes to the new image for redployment to Cloud RUN
COPY wordpress/wp-content/plugins/  /usr/src/wordpress/wp-content/plugins/
COPY wordpress/wp-content/themes/  /usr/src/wordpress/wp-content/themes/