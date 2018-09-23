#!/bin/bash

source bin/vars/variables.sh
source bin/vars/deps.sh

echo
echo "Checking dependencies..."

# Create temp dir
mkdir -p bin/tmp
docker cp $WP_CONTAINER:/var/www/html/wp-content/plugins/vanicacummings/composer.lock bin/tmp/
docker cp $WP_CONTAINER:/var/www/package-lock.json bin/tmp/

# If vendor and modules are different
if ! cmp www/html/wp-content/plugins/vanicacummings/composer.lock bin/tmp/composer.lock >/dev/null 2>&1 && ! cmp www/package-lock.json bin/tmp/package-lock.json >/dev/null 2>&1; then
  docker exec -it $WP_CONTAINER bash -c "rm -rf /var/www/html/wp-content/plugins/vanicacummings/vendor /var/www/node_modules"
  docker cp www/html/wp-content/plugins/vanicacummings/composer.lock $WP_CONTAINER:/var/www/html/wp-content/plugins/vanicacummings/
  docker cp www/package-lock.json $WP_CONTAINER:/var/www/
  deps

# If vendor is different
elif ! cmp www/html/wp-content/plugins/vanicacummings/composer.lock bin/tmp/composer.lock >/dev/null 2>&1; then
  docker exec -it $WP_CONTAINER bash -c "/var/www/html/wp-content/plugins/vanicacummings/vendor"
  docker cp www/html/wp-content/plugins/vanicacummings/composer.lock $WP_CONTAINER:/var/www/html/wp-content/plugins/vanicacummings/
  deps

# If modules are different
elif ! cmp www/package-lock.json bin/tmp/package-lock.json >/dev/null 2>&1; then
  docker exec -it $WP_CONTAINER bash -c "rm -rf /var/www/node_modules"
  docker cp www/package-lock.json $WP_CONTAINER:/var/www/
  deps
fi

# Remove temp dir
rm -rf bin/tmp
