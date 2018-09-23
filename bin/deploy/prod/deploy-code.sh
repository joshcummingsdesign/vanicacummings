#!/bin/bash

source bin/vars/variables.sh

echo "Deploying..."
echo
mv www/html/wp-content/themes/vanicacummings ~/dist/wp-content/themes/
mv www/html/wp-content/plugins/vanicacummings ~/dist/wp-content/plugins/
mv docker/.htaccess ~/dist/
mv docker/deploy-gitignore.txt ~/dist/.gitignore
cd ~/dist
git config --global user.email "hello@joshcummingsdesign.com"
git config --global user.name "Josh Cummings"
git init
git remote add production git@git.wpengine.com:production/ccbstg.git
git add .
git commit -am "Deployed by CircleCI"
git push -f production master
