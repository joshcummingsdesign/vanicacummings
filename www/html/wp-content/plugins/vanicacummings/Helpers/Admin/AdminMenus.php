<?php namespace VanicaCummings\Helpers\Admin;

/**
 * The AdminMenus class.
 */
class AdminMenus {

  /**
   * The AdminMenus class constructor.
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Hook into actions and filters.
   */
  private function init() {
    add_action('admin_menu', [$this, 'removeMenus'], 999);
  }

  /**
   * Remove specified menus from the admin.
   */
  public function removeMenus() {
    if (jcdIsProd() || jcdIsStaging()) {
      remove_menu_page('edit.php?post_type=acf-field-group');
      remove_menu_page('pods');
    }
  }
}
