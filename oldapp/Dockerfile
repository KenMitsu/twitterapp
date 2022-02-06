FROM php:7.2-apache
MAINTAINER kenshiro <km3zch1058@gmail.com>

RUN apt-get update
RUN apt-get install -y vim
RUN set -ex apk --no-cache add postgresql-dev libpq-dev
RUN apt-get install -y libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql mbstring
RUN docker-php-ext-install mbstring

# yum アップデートとcronのインストール
RUN yum update -y --disableplugin=fastestmirror && \
    yum install -y epel-release --disableplugin=fastestmirror && \
    yum install -y --disableplugin=fastestmirror sudo cronie

# 実行ユーザを追加（全てrootで行う場合は不要です、この場合crontabのコマンド起動ユーザをrootにする必要があります）
# sudoersへの追加は必要な場合のみで問題ありません
# (cronで実行するコマンドにsudoが含まれる場合に必要です)
RUN groupadd -g 1000 developer && \
    useradd  -g      developer -m -s /bin/bash dev-user && \
    echo 'dev-user    ALL=(ALL)    NOPASSWD:ALL' >> /etc/sudoers.d/dev-user

# PAMの設定
RUN sed -i -e '/pam_loginuid.so/s/^/#/' /etc/pam.d/crond

# Dockerfileと同じ階層の"cron.d"フォルダ内にcronの処理スクリプトを格納しておく
ADD cron.d /etc/cron.d/
RUN chmod 0644 /etc/cron.d/*

CMD crond && tail -f /dev/null