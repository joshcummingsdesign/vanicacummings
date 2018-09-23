<?php namespace VanicaCummings\Helpers\Theme;

/**
 * The ThemeRoutes class.
 */
class ThemeRoutes {

  /**
   * The ThemeRoutes class constructor.
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Init routes
   */
  private function init() {
    $routerFindUs = new Routes\RouterFindUs();
  }
}
