<?php

/**
 * PHPUnit bootstrap file
 */
$_tests_dir = getenv('WP_TESTS_DIR');
if (!$_tests_dir) {
  $_tests_dir = '/tmp/wordpress-tests-lib';
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load plugins.
 */
function _manually_load_plugin() {
  require dirname(dirname(__FILE__)) . '/../advanced-custom-fields-pro/acf.php';
  require dirname(dirname(__FILE__)) . '/vanicacummings.php';
}
tests_add_filter('muplugins_loaded', '_manually_load_plugin');

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
