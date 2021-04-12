FROM httpd:2.4-alpine

# Apache configuration
ARG APACHE_SERVER_NAME
ENV SERVER_NAME=${APACHE_SERVER_NAME:-localhost}
RUN mkdir -p /var/log/apache2
COPY ./config/httpd.conf /usr/local/apache2/conf/httpd.conf
COPY ./config/custom.conf /usr/local/apache2/conf/extra/httpd-custom.conf
COPY ./config/php-fpm.conf /usr/local/apache2/conf/extra/httpd-php-fpm.conf
COPY ./config/vhost.conf /usr/local/apache2/conf/extra/vhost.conf
RUN sed -i "s/ServerName localhost/ServerName $SERVER_NAME/g" /usr/local/apache2/conf/extra/vhost.conf

EXPOSE 80
WORKDIR /var/www/html
CMD ["httpd-foreground"]
