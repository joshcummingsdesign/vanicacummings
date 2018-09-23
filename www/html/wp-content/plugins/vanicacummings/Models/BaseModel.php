<?php namespace VanicaCummings\Models;

/**
 * The BaseModel class.
 */
class BaseModel {

  /**
   * Get the body class data.
   *
   * @return string The body classes
   */
  public function getBodyClass() {
    return join(' ', get_body_class());
  }

  /**
   * Get the site data.
   *
   * @return object The site data
   */
  public function getSite() {
    return (object)[
      'url' => esc_url(home_url('/')),
      'language' => get_bloginfo('language'),
      'title' => get_bloginfo('name'),
      'charset' => get_bloginfo('charset')
    ];
  }

  /**
   * Get the menu data.
   *
   * @return object The menu data
   */
  public function getMenus() {

    $registeredMenus = get_registered_nav_menus();

    $menuData = (object)[];

    foreach ($registeredMenus as $menuDataSlug => $menuDataTitle) {
      $menuData->$menuDataSlug = new \Timber\Menu($menuDataSlug);
    }

    return jcdNormalizeMenus($menuData);
  }

  /**
   * Get the footer data.
   *
   * @return object The footer data
   */
  public function getFooter() {
    $footer = (object)[
      'copyright' => '2018 &copy; VanicaCummings'
    ];
    return $footer;
  }

  /**
   * Get the path to the images in the theme.
   *
   * @return string The images path
   */
  public function getImages() {
    $images = JCDWP_THEME_ASSET_URI . '/images';
    return $images;
  }

  /**
   * Return true if the user is on a mobile device.
   *
   * @return int/bool 1 if mobile, 0 if not mobile, false if error
   */
  public function getIsMobile() {
    $regex = '/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    return preg_match($regex, $userAgent);
  }

  /**
   * Get the post data
   *
   * @return object The post data
   */
  public function getPost() {
    $post = new \Timber\Post();
    return $post;
  }

  /**
   * Get the posts
   *
   * @return array The posts
   */
  public function getPosts() {
    $posts = new \Timber\PostQuery();
    return $posts;
  }
}
