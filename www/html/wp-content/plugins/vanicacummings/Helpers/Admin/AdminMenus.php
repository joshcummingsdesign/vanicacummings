<?php namespace VanicaCummings\Helpers\Admin;

/**
 * The Controller class.
 */
class AdminMenus {

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
    add_action('admin_menu', [$this, 'removeMenus']);
  }

  /**
   * Pipe the styles into the admin editor.
   */
  public function removeMenus() {
    if (jcdIsProd() || jcdIsStaging()) {
      remove_menu_page('edit.php?post_type=acf-field-group'); //ACF
    }
  }
}
