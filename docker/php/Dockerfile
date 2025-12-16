FROM php:8.4.3-fpm-alpine

####### BUILD ARGUMENTS
ARG PHP_MEMORY_LIMIT
ARG PHP_MAX_EXECUTION_TIME
ARG PHP_MAX_UPLOAD
ARG PHP_MAX_FILE_UPLOAD
ARG PHP_MAX_POST
ARG OPCACHE_MEMORY_CONSUMPTION
ARG OPCACHE_INTERNED_STRINGS_BUFFER
ARG OPCACHE_MAX_ACCELERATED_FILES
ARG OPCACHE_REVALIDATE_FREQ
ARG OPCACHE_FAST_SHUTDOWN
ARG OPCACHE_ENABLE_CLI
ARG COMPOSER_VERSION

####### INSTALL SYSTEM DEPENDENCIES
RUN apk upgrade --update-cache --available && apk --update --no-cache add \
    openssl nginx curl build-base cmake file libmemcached-dev libxml2-dev \
    imagemagick-dev pcre-dev libc-dev pkgconf libtool make autoconf g++ \
    cyrus-sasl-dev libgsasl-dev freetype-dev libjpeg-turbo-dev libzip-dev \
    libpng-dev icu-dev libc6-compat gettext-dev libxslt-dev supervisor gcc \
    shadow curl-dev openssl-dev openssh bash

####### PHP EXTENSIONS
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) mysqli pdo pdo_mysql opcache pcntl gd \
    bcmath zip exif gettext shmop sysvmsg sysvsem sysvshm xsl ftp intl && \
    pecl channel-update pecl.php.net && \
    pecl install imagick redis igbinary msgpack && \
    docker-php-ext-enable imagick redis igbinary msgpack

####### PHP CONFIG (apply to both ini files, then copy production)
RUN for ini in php.ini-development php.ini-production; do \
        sed -i \
            -e "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" \
            -e "s/variables_order = \"GPCS\"/variables_order = \"EGPCS\"/" \
            -e "s|;*memory_limit =.*|memory_limit = ${PHP_MEMORY_LIMIT}|i" \
            -e "s|;*max_execution_time =.*|max_execution_time = ${PHP_MAX_EXECUTION_TIME}|i" \
            -e "s|;*upload_max_filesize =.*|upload_max_filesize = ${PHP_MAX_UPLOAD}|i" \
            -e "s|;*max_file_uploads =.*|max_file_uploads = ${PHP_MAX_FILE_UPLOAD}|i" \
            -e "s|;*post_max_size =.*|post_max_size = ${PHP_MAX_POST}|i" \
            -e "s|;*opcache.memory_consumption=.*|opcache.memory_consumption=${OPCACHE_MEMORY_CONSUMPTION}|i" \
            -e "s|;*opcache.interned_strings_buffer=.*|opcache.interned_strings_buffer=${OPCACHE_INTERNED_STRINGS_BUFFER}|i" \
            -e "s|;*opcache.max_accelerated_files=.*|opcache.max_accelerated_files=${OPCACHE_MAX_ACCELERATED_FILES}|i" \
            -e "s|;*opcache.revalidate_freq=.*|opcache.revalidate_freq=${OPCACHE_REVALIDATE_FREQ}|i" \
            -e "s|;*opcache.fast_shutdown=.*|opcache.fast_shutdown=${OPCACHE_FAST_SHUTDOWN}|i" \
            -e "s|;*opcache.enable_cli=.*|opcache.enable_cli=${OPCACHE_ENABLE_CLI}|i" \
            /usr/local/etc/php/$ini; \
    done && \
    cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

####### PHP-FPM CONFIG
RUN sed -i "s/;daemonize = yes/daemonize = no/" /usr/local/etc/php-fpm.conf && \
    sed -i \
        -e "s/pm = dynamic/pm = ondemand/" \
        -e "s/pm.max_children = 5/pm.max_children = 250/" \
        -e "s/pm.start_servers = 2/pm.start_servers = 70/" \
        -e "s/pm.min_spare_servers = 1/pm.min_spare_servers = 70/" \
        -e "s/pm.max_spare_servers = 3/pm.max_spare_servers = 80/" \
        -e "s/;pm.max_requests = 500/pm.max_requests = 500/" \
        -e "s/;pm.process_idle_timeout = 10s/pm.process_idle_timeout = 30s/" \
        /usr/local/etc/php-fpm.d/www.conf

####### INSTALL COMPOSER & CLEANUP
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION} && \
    rm -rf /tmp/* /var/cache/apk/*

####### SECURITY FIXES & SYSTEM CONFIG
RUN delgroup dialout && \
    sed -i 's/^root::/root:!:/' /etc/shadow && \
    sed -i 's#/bin/ash#/bin/bash#g' /etc/passwd

####### NGINX SETUP
RUN rm -rf /etc/nginx/conf.d/* /etc/nginx/sites-available/default /etc/nginx/nginx.conf && \
    mkdir -p /run/nginx /etc/nginx/conf.d /var/lib/nginx/tmp /var/log/nginx && \
    chown -R www-data:www-data /var/lib/nginx /var/log/nginx && \
    chmod -R 755 /var/lib/nginx /var/log/nginx

####### APPLICATION DIRECTORY SETUP
RUN mkdir -p /var/www/backend/storage && \
    touch /var/www/backend/storage/oauth-private.key /var/www/backend/storage/oauth-public.key && \
    chmod -R 777 /var/www/backend/storage && \
    chmod 600 /var/www/backend/storage/oauth-*.key && \
    chown www-data:www-data /var/www/backend/storage/oauth-*.key

####### COPY CONFIG FILES
ADD app/site/default.conf /etc/nginx/conf.d/
ADD app/config/webserver.conf /etc/nginx/nginx.conf
ADD app/supervisor/supervisord.conf /etc/supervisord.conf
ADD app/supervisor/webserver.conf /etc/supervisor.d/cron.conf

####### ENVIRONMENT
ENV SHELL=/bin/bash
EXPOSE 80
WORKDIR /var/www/backend
