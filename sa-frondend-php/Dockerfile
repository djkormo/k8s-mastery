FROM ulsmith/alpine-apache-php7
MAINTAINER DjKormo <djkormo@gmail.com>

ADD /public /app/public
COPY *.php /app/public
RUN chown -R apache:apache /app


