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
    add_image_size('small_square', 300, 300);
    add_image_size('medium_square', 480, 480);
    add_image_size('large_square', 600, 600);
    add_image_size('post_thumb', 600, 350);
    add_image_size('large', 800, 600);
    add_image_size('full_width', 1440, 600);
  }
}
