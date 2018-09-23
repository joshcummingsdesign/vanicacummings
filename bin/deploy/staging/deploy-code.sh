#!/bin/bash

source bin/vars/variables.sh

echo "Deploying theme..."
echo
rsync -azq --partial --delete www/html/wp-content/themes/vanicacummings/ \
  $STG_USER@$STG_IP:applications/$STG_DB/public_html/wp-content/themes/vanicacummings/

echo
echo "==========================="
echo

echo "Deploying plugins..."
echo
rsync -azq --partial --delete www/html/wp-content/plugins/vanicacummings/ \
  $STG_USER@$STG_IP:applications/$STG_DB/public_html/wp-content/plugins/vanicacummings/

echo
echo "==========================="
echo

echo "Deploying Pattern Lab..."
echo
rsync -azq --partial --delete www/html/patternlab/ \
  $STG_USER@$STG_IP:applications/$STG_DB/public_html/patternlab/
