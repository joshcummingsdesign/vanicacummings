#!/bin/bash

# Variables
source bin/vars/variables.sh

docker exec -it $WP_CONTAINER bash -c "source ~/.bashrc \
  && echo \
    && echo 'Checking for vulnerabilities...' \
    && echo \
    && npm audit --production \
    && cd html/wp-content/plugins/vanicacummings \
    && composer audit --no-dev \
    && cd /var/www \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Validating JavaScript...' \
  && echo \
  && npx gulp scripts-lint \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Running JavaScript unit tests...' \
  && npm test \
  && echo '===========================' \
  && echo \
  && echo 'Running PHP unit tests...' \
  && echo \
    && html/wp-content/plugins/vanicacummings/vendor/bin/phpunit \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Testing PHP coding standards...' \
  && echo \
  && phpcs --standard=phpcs.xml \
  && echo"
