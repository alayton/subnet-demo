FROM httpd:2.4-alpine

RUN sed -i '/LoadModule proxy_fcgi_module/s/^#//g' /usr/local/apache2/conf/httpd.conf && \
    sed -i '/LoadModule ssl_module/s/^#//g' /usr/local/apache2/conf/httpd.conf && \
    sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf && \
    sed -i '/LoadModule proxy_module/s/^#//g' /usr/local/apache2/conf/httpd.conf && \
    sed -i "/Include conf\/extra\/httpd-vhosts.conf/s/^#//g" /usr/local/apache2/conf/httpd.conf && \
    sed -i '/Global configuration/a \
ServerName localhost \
' /usr/local/apache2/conf/httpd.conf
EXPOSE 80 443
RUN rm -f /run/apache2/apache2.pid
CMD apachectl  -DFOREGROUND -e info