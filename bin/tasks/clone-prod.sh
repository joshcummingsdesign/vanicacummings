#!/bin/bash

# Pretty Print
source bin/vars/pretty-print.sh

# Variables
source bin/vars/variables.sh

# Make sure the local mysql container is running
IS_RUNNING=$(docker inspect -f {{.State.Running}} $MYSQL_CONTAINER)
if [[ $IS_RUNNING != "true" ]]; then
  pretty_print "${COL_RED}Database container not running. Try${COL_RESET} ${COL_MAGENTA}make start${COL_RESET} ${COL_RED}first.${COL_RESET}"
  exit 1
fi

# Warn the user
pretty_print "${COL_YELLOW}WARNING: Your local database and wp-content folder will be replaced!${COL_RESET}"
pretty_read "${COL_BLUE}Are you sure you want to continue? (y|N): ${COL_RESET}" PROCEED

if [[ $PROCEED == "y" ]]; then

  # Generate a 6 digit random number
  COUNTER=0
  CONFIRM=$((1 + RANDOM % 9))
  while [ $COUNTER -lt 5 ]; do
      CONFIRM=$CONFIRM$((1 + RANDOM % 9))
      let COUNTER=COUNTER+1
  done

  pretty_read "${COL_BLUE}Confirm that you want to do this by typing $CONFIRM: ${COL_RESET}" INPUT

  if [[ $CONFIRM == $INPUT ]]; then

    echo "One moment please..."

    docker exec -it $WP_CONTAINER bash -c "mkdir -p tmp \
      && echo 'Retrieving database...' \
      && ssh $PROD_USER@$PROD_IP 'PROD_DB="${PROD_DB}" \
        && cd vanicacummings.com; \
          if [ ! -f staging.sql ]; then \
            wp db export staging.sql; \
          else \
            echo 'Someone is currently cloning.'; \
            echo 'Please wait and try again.'; \
            echo 'If issue persists, delete staging.sql from the server.'; \
            exit 5; \
          fi' \
      && rsync -azP $PROD_USER@$PROD_IP:vanicacummings.com/staging.sql tmp/staging.sql \
      && echo 'Cleaning up staging...' \
      && ssh $PROD_USER@$PROD_IP 'PROD_DB="${PROD_DB}" \
        && rm vanicacummings.com/staging.sql;' \
      && echo 'Resetting the database...' \
      && cd html \
      && wp db reset --yes \
      && echo 'Importing the database...' \
      && wp db import ../tmp/staging.sql \
      && echo 'Performing search and replace...' \
      && echo 'This may take a moment...' \
      && wp search-replace '"$PROD_DOMAIN"' 'localhost' --all-tables \
      && echo 'Cleaning up...' \
      && rm -rf ../tmp \
      && echo 'Gathering files...' \
      && rsync -azP --delete $PROD_USER@$PROD_IP:vanicacummings.com/wp-content/uploads/ wp-content/uploads/ \
      && rsync -azP --delete $PROD_USER@$PROD_IP:vanicacummings.com/wp-content/plugins/ wp-content/plugins/ \
      && chown -R www-data:www-data wp-content \
      && wp plugin deactivate \
        w3-total-cache"

  else
    pretty_print "${COL_RED}Confirmation number did not match.${COL_RESET}"
    exit 4
  fi
else
  exit 3
fi
