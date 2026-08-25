<?php namespace VanicaCummings\Helpers\Core;

/**
 * The CoreAddons class.
 */
class CoreAddons {

  /**
   * The CoreAddons class constructor.
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Hook into actions and filters.
   */
  private function init() {
    add_action('save_post', [$this, 'setHomePage']);
    add_filter('wp_terms_checklist_args', [$this, 'checkedCategories']);
    add_filter('pre_get_posts', [$this, 'filterSearch']);
  }

  /**
   * Set "Home" page as front page.
   */
  public function setHomePage() {
    $homepage = new \WP_Query([
      'post_type' => 'page',
      'title' => 'Home',
      'posts_per_page' => 1
    ]);
    if ($homepage->have_posts()) {
      update_option('page_on_front', $homepage->posts[0]->ID);
      update_option('show_on_front', 'page');
    }
  }

  /**
   * Keep checked categories in place.
   *
   * @param array $args An array of arguments passed by WordPress.
   */
  public function checkedCategories($args) {
    $args['checked_ontop'] = false;
    return $args;
  }

  /**
   * Only allow posts in search query.
   *
   * @param array $query The search query passed by WordPress.
   */
  public function filterSearch($query) {
    if ($query->is_search && !is_admin()) {
      $query->set('post_type', ['post']);
    }
    return $query;
  }
}
