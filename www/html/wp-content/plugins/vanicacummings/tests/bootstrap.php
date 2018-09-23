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
  define('WC_TAX_ROUNDING_MODE', 'auto'); // Needed for Woocommerce
  require dirname(dirname(__FILE__)) . '/../woocommerce/woocommerce.php';
  require dirname(dirname(__FILE__)) . '/../advanced-custom-fields/acf.php';
  require dirname(dirname(__FILE__)) . '/vanicacummings.php';
}
tests_add_filter('muplugins_loaded', '_manually_load_plugin');

/**
 * Set up Woocommerce for testing.
 */
function _setup_woocommerce() {

  // Clean existing install first.
  define('WP_UNINSTALL_PLUGIN', true);
  define('WC_REMOVE_ALL_DATA', true);

  include dirname(dirname(__FILE__)) . '/../woocommerce/uninstall.php';

  WC_Install::install();

  // Reload capabilities after install, see https://core.trac.wordpress.org/ticket/28374
  if (version_compare($GLOBALS['wp_version'], '4.7', '<')) {
    $GLOBALS['wp_roles']->reinit();
  } else {
    $GLOBALS['wp_roles'] = null;
    wp_roles();
  }
}
tests_add_filter('setup_theme', '_setup_woocommerce');

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
