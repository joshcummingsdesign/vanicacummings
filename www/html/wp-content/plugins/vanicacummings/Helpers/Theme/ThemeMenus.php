<?php namespace VanicaCummings\Helpers\Theme;

/**
 * The ThemeMenus class.
 */
class ThemeMenus {

  /**
   * The ThemeMenus class constructor.
   */
  public function __construct() {
    $this->registerMenus();
  }

  /**
   * Register the theme's menus.
   *
   * https://developer.wordpress.org/reference/functions/register_nav_menus/
   */
  private function registerMenus() {
    register_nav_menus([
      'main_menu' => __('Main Menu', 'jcdwp')
    ]);
  }
}
