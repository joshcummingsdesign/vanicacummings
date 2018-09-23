#!/bin/bash

source bin/vars/variables.sh

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

echo
echo "==========================="
echo

echo "Deploying Pattern Lab..."
echo
rsync -azq --partial --delete www/html/patternlab/ \
  $DEV_USER@$DEV_IP:applications/$DEV_DB/public_html/patternlab/
