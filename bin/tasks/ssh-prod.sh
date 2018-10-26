#!/bin/bash

source bin/vars/variables.sh

ssh -t $PROD_USER@$PROD_IP "cd vanicacummings.com; bash"
