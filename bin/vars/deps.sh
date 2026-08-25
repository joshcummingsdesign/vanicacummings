#!/bin/bash

source bin/vars/variables.sh

deps() {
  docker exec -i $WP_CONTAINER bash -c "source ~/.bashrc \
    && echo \
    && echo 'Running npm install...' \
    && echo \
    && npm ci --production=false \
    && echo \
    && echo '===========================' \
    && echo \
    && echo 'Running composer install...' \
    && echo \
    && cd html/wp-content/plugins/vanicacummings \
    && COMPOSER_ALLOW_SUPERUSER=1 composer install -o \
    && echo"
}
