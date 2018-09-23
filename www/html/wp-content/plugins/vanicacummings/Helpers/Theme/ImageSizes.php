<?php namespace VanicaCummings\Helpers\Theme;

/**
 * The ImageSizes class.
 */
class ImageSizes {

  /**
   * The ImageSizes class constructor.
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Hook into actions and filters.
   */
  private function init() {
    add_action('after_setup_theme', [$this, 'add']);
  }

  /**
   * Add image sizes.
   *
   * https://developer.wordpress.org/reference/functions/add_image_size/
   */
  public function add() {
    add_image_size('medium', 800, 600);
  }
}
