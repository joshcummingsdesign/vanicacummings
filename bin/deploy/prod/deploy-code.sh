#!/bin/bash

source bin/vars/variables.sh

sudo apt-get update && sudo apt-get install rsync
ssh-keyscan -H $PROD_IP >> ~/.ssh/known_hosts

echo "Deploying theme..."
echo
rsync -azq --partial --delete www/html/wp-content/themes/vanicacummings/ \
  $PROD_USER@$PROD_IP:vanicacummings.com/wp-content/themes/vanicacummings/

echo
echo "==========================="
echo

echo "Deploying plugins..."
echo
rsync -azq --partial --delete www/html/wp-content/plugins/vanicacummings/ \
  $PROD_USER@$PROD_IP:vanicacummings.com/wp-content/plugins/vanicacummings/
