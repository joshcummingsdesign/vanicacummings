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
      'main' => __('Main Menu', 'jcdwp'),
      'footer' => __('Footer Menu', 'jcdwp'),
      'social' => __('Social Media', 'jcdwp'),
      'terms' => __('Privacy & Terms', 'jcdwp')
    ]);
  }
}
