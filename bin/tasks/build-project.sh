#!/bin/bash

source bin/vars/variables.sh

docker exec -i $WP_CONTAINER bash -c "source ~/.bashrc \
  && echo \
  && echo 'Building the project...' \
  && echo \
  && npx gulp"
