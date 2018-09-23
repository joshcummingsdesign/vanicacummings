#!/bin/bash

source bin/vars/variables.sh

echo "Removing old lock files..."
docker exec -it $WP_CONTAINER bash -c "\
  rm -rf html/wp-content/plugins/vanicacummings/composer.lock package-lock.json"
echo
echo "==========================="
echo
