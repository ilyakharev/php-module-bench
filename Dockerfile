FROM ubuntu:20.04
RUN apt-get upgrade
RUN apt-get update
RUN apt-get install -y software-properties-common
RUN apt-get update
RUN add-apt-repository -y ppa:ondrej/php
RUN apt-get update

ARG PHP="7.2"

RUN apt-get install -y php${PHP}
RUN apt-get update

ARG PRELOAD="echo 1;"
COPY app.php .
COPY Jwt.php .
COPY composer.json .

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN apt-get install -y git
RUN composer update

RUN echo "${PRELOAD}"
RUN ${PRELOAD}

ENTRYPOINT ["php", "app.php"]