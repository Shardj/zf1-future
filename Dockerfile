FROM eu.gcr.io/fgrp-repository/devops/php:8.2

RUN apk upgrade &&\
    apk add git libxml2-dev

COPY ./docker/php/assets/php.ini /usr/local/etc/php/php.ini