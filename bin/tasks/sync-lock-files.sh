#!/bin/bash

source bin/vars/variables.sh

echo "Syncing lock files to local..."
docker cp $WP_CONTAINER:/var/www/html/wp-content/plugins/vanicacummings/composer.lock www/html/wp-content/plugins/vanicacummings/
docker cp $WP_CONTAINER:/var/www/package-lock.json www/
echo "Sync complete!"
