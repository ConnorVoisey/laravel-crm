FROM webdevops/php-nginx:8.2-alpine
ENV WEB_DOCUMENT_ROOT=/app/public
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PHP_DISMOD=bz2,calendar,exiif,ffi,intl,gettext,ldap,mysqli,imap,pdo_pgsql,pgsql,soap,sockets,sysvmsg,sysvsm,sysvshm,shmop,xsl,zip,gd,apcu,vips,yaml,imagick,mongodb,amqp
RUN echo extension=pdo_pgsql >> /opt/docker/etc/php/php.ini
RUN echo extension=pgsql >> /opt/docker/etc/php/php.ini
RUN apk add postgresql
RUN apk add php-pgsql
WORKDIR /app
COPY . .
RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN php artisan optimize
RUN chown -R application:application .
