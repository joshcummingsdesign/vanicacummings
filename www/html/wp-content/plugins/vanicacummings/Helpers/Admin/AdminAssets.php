<?php namespace VanicaCummings\Helpers\Admin;

use VanicaCummings\Helpers\AssetPath as AssetPath;

/**
 * The Controller class.
 */
class AdminAssets {

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
    add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    add_action('after_setup_theme', [$this, 'editorStyles']);
  }

  /**
   * Enqueue assets for the admin.
   */
  public function enqueue() {

    // admin.js
    wp_enqueue_script(
      'jcd/admin-js',
      AssetPath::get('scripts/admin.js'),
      ['jquery'],
      null,
      true
    );
  }

  /**
   * Pipe the styles into the admin editor.
   */
  public function editorStyles() {
    add_editor_style(AssetPath::get('styles/main.css'));
  }
}
