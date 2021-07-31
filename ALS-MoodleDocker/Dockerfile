# Docker-Moodle
# Dockerfile for moodle instance. more dockerish version of https://github.com/sergiogomez/docker-moodle
# Forked from Jade Auer's docker version. https://github.com/jda/docker-moodle
# Forked from Jonathan Hardison's docker version. https://github.com/jmhardison/docker-moodle
FROM ubuntu:20.04
LABEL maintainer="Maxwell Hunsinger <mhunsinger@fas.harvard.edu>"

VOLUME ["/var/moodledata"]
EXPOSE 80 443
COPY moodle-config.php /var/www/html/config.php

# Let the container know that there is no tty
ENV DEBIAN_FRONTEND noninteractive

# Database info and other connection information derrived from env variables. See readme.
# Set ENV Variables externally Moodle_URL should be overridden.
ENV MOODLE_URL http://127.0.0.1

# Enable when using external SSL reverse proxy
# Default: false
ENV SSL_PROXY false

COPY ./foreground.sh /etc/apache2/foreground.sh

RUN apt-get update && \
	apt-get -y install mysql-client pwgen python-setuptools curl git unzip apache2 php \
		php-gd libapache2-mod-php postfix wget supervisor php-pgsql curl libcurl4 vim\
		libcurl3-dev php-curl php-xmlrpc php-intl php-mysql git-core php-xml php-mbstring php-zip php-soap cron php-ldap && \
	cd /tmp && \
	git clone --single-branch --branch master https://github.com/zors2ge00s2/ALS-Moodle.git --depth=1 && \
	mv ALS-Moodle/html moodle && \
	mv /tmp/moodle/* /var/www/html/ && \
	rm /var/www/html/index.html && \
	chown -R www-data:www-data /var/www/html && \
	chmod +x /etc/apache2/foreground.sh

#cron
COPY moodlecron /etc/cron.d/moodlecron
RUN chmod 0644 /etc/cron.d/moodlecron

#PHP upload size config
#RUN sed -i -e "s/^ *memory_limit.*/memory_limit = 1G/g" /usr/local/etc/php/conf.d/php.ini
#RUN sed -i -e "s/^ *post_max_size.*/post_max_size = 1G/g" /usr/local/etc/php/conf.d/php.ini
#RUN sed -i -e "s/^ *upload_max_filesize.*/upload_max_filesize = 1G/g" /usr/local/etc/php/conf.d/php.ini

RUN sed -i -e "s/^ *memory_limit.*/memory_limit = 1G/g" /etc/php/7.4/cli/php.ini
RUN sed -i -e "s/^ *post_max_size.*/post_max_size = 1G/g" /etc/php/7.4/cli/php.ini
RUN sed -i -e "s/^ *upload_max_filesize.*/upload_max_filesize = 1G/g" /etc/php/7.4/cli/php.ini

RUN sed -i -e "s/^ *memory_limit.*/memory_limit = 1G/g" /etc/php/7.4/apache2/php.ini
RUN sed -i -e "s/^ *post_max_size.*/post_max_size = 1G/g" /etc/php/7.4/apache2/php.ini
RUN sed -i -e "s/^ *upload_max_filesize.*/upload_max_filesize = 1G/g" /etc/php/7.4/apache2/php.ini

# Enable SSL, moodle requires it
RUN a2enmod ssl && a2ensite default-ssl  #if using proxy dont need actually secure connection

# Cleanup, this is ran to reduce the resulting size of the image.
RUN apt-get clean autoclean && apt-get autoremove -y && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/lib/dpkg/* /var/lib/cache/* /var/lib/log/*

ENTRYPOINT ["/etc/apache2/foreground.sh"]
