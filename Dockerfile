FROM php:7.2-apache
MAINTAINER kenshiro <km3zch1058@gmail.com>

RUN apt-get update
RUN apt-get install -y vim
RUN set -ex apk --no-cache add postgresql-dev libpq-dev
RUN apt-get install -y libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql mbstring
RUN docker-php-ext-install mbstring

RUN apt install -y cron
RUN echo * * * * * /var/www/html /Users/mitsuishikenshirou/Desktop/PHP_samplefile/twitterapp/main.php >> /etc/crontab
CMD ["cron", "-f"]