#!/bin/bash

source bin/vars/variables.sh

sudo apt-get update && sudo apt-get install -y rsync
ssh-keyscan -T 10 -H $PROD_IP >> ~/.ssh/known_hosts

SSH_OPTIONS="-o BatchMode=yes -o ConnectTimeout=15"

ssh $SSH_OPTIONS $PROD_USER@$PROD_IP true

echo "Deploying theme..."
echo
rsync -e "ssh $SSH_OPTIONS" -azq --partial --delete www/html/wp-content/themes/vanicacummings/ \
  $PROD_USER@$PROD_IP:vanicacummings.com/wp-content/themes/vanicacummings/

echo
echo "==========================="
echo

echo "Deploying plugins..."
echo
rsync -e "ssh $SSH_OPTIONS" -azq --partial --delete www/html/wp-content/plugins/vanicacummings/ \
  $PROD_USER@$PROD_IP:vanicacummings.com/wp-content/plugins/vanicacummings/
