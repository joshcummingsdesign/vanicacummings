<?php

function jcdIsProd() {
  return defined('WP_ENV') && WP_ENV === 'prod';
}

function jcdIsStaging() {
  return defined('WP_ENV') && WP_ENV === 'staging';
}
