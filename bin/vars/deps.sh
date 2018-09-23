#!/bin/bash

source bin/vars/variables.sh

deps() {
  docker exec -it $WP_CONTAINER bash -c "source ~/.bashrc \
    && echo \
    && echo 'Running npm install...' \
    && echo \
    && npm install \
    && echo \
    && echo '===========================' \
    && echo \
    && echo 'Running composer install...' \
    && echo \
    && cd html/wp-content/plugins/vanicacummings \
    && COMPOSER_ALLOW_SUPERUSER=1 composer install -o \
    && echo"
}
