FROM alpine:3.8

RUN apk add --update --no-cache \
    php7 \
    php7-fpm \
    php7-memcached \
    php7-ctype \
    php7-json

RUN { \
        echo '[global]'; \
        echo 'error_log = /proc/self/fd/2'; \
        echo 'include=/etc/php7/php-fpm.d/*.conf'; \
    } | tee /etc/php7/php-fpm.conf \
    && { \
        echo '[www]'; \
        echo 'user = catho'; \
        echo 'group = catho'; \
        echo 'listen = 9000'; \
        echo 'pm = dynamic'; \
        echo 'pm.max_children = 5'; \
        echo 'pm.start_servers = 2'; \
        echo 'pm.min_spare_servers = 1'; \
        echo 'pm.max_spare_servers = 3'; \
        echo 'access.log = /proc/self/fd/2'; \
        echo 'catch_workers_output = yes'; \
        echo 'clear_env = no'; \
        echo 'php_admin_flag[log_errors] = on'; \
        echo 'php_admin_value[error_log] = /proc/self/fd/2'; \
    } | tee /etc/php7/php-fpm.d/www.conf

# user
RUN addgroup -g 1000 catho \
    && adduser -S -u 1000 -G catho catho

USER catho
WORKDIR /home/catho

EXPOSE 9000

CMD ["php-fpm7", "--nodaemonize", "--force-stderr"]
