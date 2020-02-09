## https://github.com/docker-library/wordpress
FROM wordpress:5.2.4-php7.2-apache

MAINTAINER EvgeniyPopov 1212evgen@gmail.com

# NOTE:
# Do NOT set WORKDIR as the entrypoint script provided by WordPress
# has assumptions about the working directory when it runs and the
# build will be boken if its set here.

# Setup required build binaries
RUN apt-get update
RUN apt-get install unzip

# Pull the config into the final hosted directory
ADD ./wordpress/wp-config.php /var/www/html/

# Remove the default plugins and themes
RUN rm -rf /usr/src/wordpress/wp-content/plugins/hello.php
RUN rm -rf /usr/src/wordpress/wp-content/themes/*

########### Install common dependencies ################
COPY wordpress/wp-content/plugins/woocommerce /usr/src/wordpress/wp-content/plugins/woocommerce