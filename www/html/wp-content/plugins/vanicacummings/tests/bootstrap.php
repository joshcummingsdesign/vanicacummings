<?php

/**
 * PHPUnit bootstrap file
 */
$_tests_dir = getenv('WP_TESTS_DIR');
if (!$_tests_dir) {
  $_tests_dir = '/tmp/wordpress-tests-lib';
}

define('WP_TESTS_PHPUNIT_POLYFILLS_PATH', dirname(__FILE__) . '/../vendor/yoast/phpunit-polyfills');

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load plugins.
 */
function _manually_load_plugin() {
  error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
  require dirname(dirname(__FILE__)) . '/../advanced-custom-fields-pro/acf.php';
  require dirname(dirname(__FILE__)) . '/vanicacummings.php';
}
tests_add_filter('muplugins_loaded', '_manually_load_plugin');

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
