FROM alpine:3.14

RUN echo 'https://mirrors.ustc.edu.cn/alpine/v3.14/community/' >  /etc/apk/repositories && \
    echo 'https://mirrors.ustc.edu.cn/alpine/v3.14/main/'      >> /etc/apk/repositories

RUN apk --no-cache add php8 php8-fpm php8-opcache php8-mysqli php8-json php8-openssl php8-curl \
    php8-zlib php8-xml php8-phar php8-intl php8-dom php8-xmlreader php8-ctype php8-session \
    php8-mbstring php8-gd nginx supervisor curl wget vim git gcc g++ openssl-dev bash

RUN ln -s /usr/bin/php8 /usr/bin/php

# 定义Nginx及虚拟机配置文件，可根据实际情况修改路径
ARG NGINX_CONF=conf/nginx/nginx.conf
ARG NGINX_WWW_CONF=conf/nginx/www.conf
ARG FPM_CONF=conf/php-fpm/php-fpm.conf
ARG FPM_WWW_CONF=conf/php-fpm/www.conf
ARG PHP_CONF=conf/php/php.ini

# 设置好系统时区为东八区
RUN apk update && apk add tzdata \
    && cp /usr/share/zoneinfo/Asia/Chongqing /etc/localtime \
    && apk del tzdata


# 覆盖Nginx及FPM配置文件
RUN rm -rf /etc/nginx/nginx.conf \
    && rm -rf /etc/nginx/conf.d/default.conf \
    && rm -rf /etc/php8/php-fpm.conf \
    && rm -rf /etc/php8/php-fpm.d/www.conf \
    && rm -rf /etc/php8/php.ini
ADD $NGINX_CONF /etc/nginx/nginx.conf
ADD $NGINX_WWW_CONF /etc/nginx/conf.d/www.conf
ADD $FPM_CONF /etc/php8/php-fpm.conf
ADD $FPM_WWW_CONF /etc/php8/php-fpm.d/www.conf
ADD $PHP_CONF /etc/php8/php.ini

# 复制 supervisor 配置文件
RUN rm -rf /etc/supervisord.conf
ADD conf/supervisord.conf /etc/supervisor/supervisord.conf

# 装载启动脚本
ADD scripts/start.sh /start.sh
RUN chmod a+x /start.sh

# 将虚拟机 root 路径暴露成卷
# 方便宿主机和容器实现目录共享
# 该值为虚拟机配置中的 root 路径，这里默认为 /var/www
# 可根据实际虚拟机配置进行修改
VOLUME /var/www

# 执行一些必要的 bash 命令来确保系统配置正常运行，可根据实际情况调整
RUN adduser -G www-data -s /sbin/nologin -D www-data && \
    chown www-data:www-data /var/lib/nginx -R


EXPOSE 80
CMD ["/start.sh"]
