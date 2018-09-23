<?php namespace VanicaCummings\Helpers\Theme;

use VanicaCummings\Helpers\AssetPath as AssetPath;

/**
 * The ThemeAssets class.
 */
class ThemeAssets {

  /**
   * The ThemeAssets class constructor.
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Hook into actions and filters.
   */
  private function init() {
    add_action('wp_enqueue_scripts', [$this, 'enqueue'], 100);
  }

  /**
   * Enqueue assets for the theme.
   */
  public function enqueue() {

    // main.css
    wp_enqueue_style(
      'jcd/css',
      AssetPath::get('styles/main.css'),
      ['jcd/prater-font'],
      null
    );

    // vendor.js
    wp_enqueue_script(
      'jcd/vendor-js',
      AssetPath::get('scripts/vendor.js'),
      ['jquery'],
      null,
      true
    );

    // app.js
    wp_enqueue_script(
      'jcd/js',
      AssetPath::get('scripts/app.js'),
      ['jquery', 'jcd/vendor-js'],
      null,
      true
    );
  }
}
