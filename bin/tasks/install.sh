#!/bin/bash

source bin/vars/variables.sh

docker exec -i $WP_CONTAINER bash -c "\
  echo \
  && cd html \
  && echo 'Downloading WordPress...' \
  && echo \
  && wp core download --force --skip-content \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Configuring WordPress...' \
  && echo \
  && wp core config --force \
    --dbname=wp \
    --dbuser=root \
    --dbhost=mysql \
    --skip-check \
    --extra-php='define(\"WP_DEBUG\", true); define(\"WP_DEBUG_DISPLAY\", false);' \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Creating database...' \
  && echo \
  && (wp db check --defaults > /dev/null 2>&1 || wp db create --defaults) \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Installing WordPress...' \
  && echo \
  && (wp core is-installed || wp core install \
    --url=https://localhost \
    --title=Josh \
    --admin_user=josh \
    --admin_password=changeme \
    --admin_email=joshcummingsdesign@gmail.com \
    --skip-email) \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Activating theme and plugins...' \
  && echo \
  && wp plugin activate advanced-custom-fields-pro vanicacummings \
  && wp theme activate vanicacummings \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Setting up WordPress test environment...' \
  && echo \
  && if [ ! -e /tmp/wordpress-tests-lib/wp-tests-config.php ]; then ./wp-content/plugins/vanicacummings/tests/bin/install-wp-tests.sh wordpress_test root '' mysql latest; else echo 'WordPress test environment already configured.'; fi \
  && echo"
