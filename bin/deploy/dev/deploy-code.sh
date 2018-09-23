#!/bin/bash

source bin/vars/variables.sh

ssh-keyscan -H $DEV_IP >> ~/.ssh/known_hosts

echo
echo "Deploying theme..."
echo
rsync -azq --partial --delete www/html/wp-content/themes/vanicacummings/ \
  $DEV_USER@$DEV_IP:applications/$DEV_DB/public_html/wp-content/themes/vanicacummings/

echo
echo "==========================="
echo

echo "Deploying plugins..."
echo
rsync -azq --partial --delete www/html/wp-content/plugins/vanicacummings/ \
  $DEV_USER@$DEV_IP:applications/$DEV_DB/public_html/wp-content/plugins/vanicacummings/
