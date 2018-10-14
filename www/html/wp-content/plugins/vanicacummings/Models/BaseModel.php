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
   * Get the path to the images in the theme.
   *
   * @return string The images path
   */
  public function getImages() {
    $images = JCDWP_THEME_ASSET_URI . '/images';
    return $images;
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
      'charset' => get_bloginfo('charset'),
      'menu_text' => get_field('menu_text', 'option'),
      'none_found_text' => get_field('none_found_text', 'option'),
      'logo' => jcdNormalizeImage(get_field('logo', 'option'))
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

    $buttons = get_field('call_to_action_buttons', 'option');
    $cta_buttons = [];

    if (!empty($buttons)) {

      foreach ($buttons as $button) {
        array_push($cta_buttons, jcdNormalizeLink($button['link']));
      }
    }

    $footer = (object)[
      'call_to_action' => (object)[
        'heading' => get_field('call_to_action_heading', 'option'),
        'buttons' => $cta_buttons
      ],
      'subscribe' => (object)[
        'opt_border' => true,
        'heading' => get_field('subscribe_heading', 'option'),
        'text' => get_field('subscribe_text', 'option'),
        'form' => (object)[
          'placeholder' => get_field('subscribe_placeholder', 'option'),
          'button_text' => get_field('subscribe_button_text', 'option')
        ]
      ],
      'sitemap_text' => get_field('sitemap_text', 'option'),
      'contact_text' => get_field('contact_text', 'option'),
      'social_text' => get_field('social_text', 'option'),
      'contact' => (object)[
        'email' => get_field('email', 'option'),
        'phone' => get_field('phone', 'option')
      ],
      'copyright' => date('Y') . ' &copy; ' . get_bloginfo('name')
    ];
    return $footer;
  }

  public function getHeader() {

    if (is_404()) {
      $heading = get_field('page_not_found_heading', 'option');
      $text = get_field('page_not_found_text', 'option');
    } elseif (is_search()) {
      $heading = get_field('search_heading', 'option');
      $text = get_field('search_results_text', 'option') . ': ' . get_search_query();
    } elseif (is_tag()) {
      $heading = get_field('tags_heading', 'option') . ': ' . get_queried_object()->name;
      $text = get_field('blog_subheading', 'option');
    } else {
      $heading = get_field('blog_heading', 'option');
      $text = get_field('blog_subheading', 'option');
    }

    return (object)[
      'heading' => $heading,
      'text' => $text
    ];
  }

  public function getSidebar() {

    $tags = [];

    $terms = get_tags();

    $slugs = [];

    if (is_single()) {
      foreach (get_the_tags(get_the_id()) as $slug) {
        array_push($slugs, $slug->slug);
      }
    } else {
      $slugs = [ get_queried_object()->slug ?? null ];
    }

    if (!empty($terms)) {

      foreach ($terms as $tag) {

        array_push($tags, (object)[
          'name' => $tag->name,
          'url' => get_tag_link($tag->term_id) ?? null,
          'is_active' => in_array($tag->slug, $slugs)
        ]);
      }
    }

    return (object)[
      'text' => get_field('sidebar_text', 'option'),
      'search' => (object)[
        'heading' => get_field('search_heading', 'option'),
        'placeholder' => get_field('search_placeholder', 'option'),
        'button_text' => get_field('search_button_text', 'option')
      ],
      'tags' => (object)[
        'heading' => get_field('tags_heading', 'option'),
        'items' => $tags
      ]
    ];
  }

  /**
   * Get the post data
   *
   * @return object The post data
   */
  public function getPost() {

    $post = jcdNormalizePost(new \Timber\Post());

    $prev_post = get_next_post(); // Reversed due to post order
    $prev_post_title = $prev_post ? $prev_post->post_title : null;
    $prev_post_url = $prev_post ? get_permalink($prev_post->ID) : null;
    $next_post = get_previous_post(); // Reversed due to post order
    $next_post_title = $next_post ? $next_post->post_title : null;
    $next_post_url = $next_post ? get_permalink($next_post->ID) : null;

    $pagination = (object)[
      'prev' => (object)[
        'name' => $prev_post_title,
        'url' => $prev_post_url
      ],
      'next' => (object)[
        'name' => $next_post_title,
        'url' => $next_post_url
      ]
    ];

    return (object)[
      'post' => $post,
      'pagination' => $pagination
    ];
  }

  /**
   * Get the posts
   *
   * @return object An object containing the posts and pagination
   */
  public function getPosts() {

    $postsQuery = new \Timber\PostQuery();

    $dbPosts = $postsQuery->get_posts();

    $posts = [];

    if (!empty($dbPosts)) {

      foreach ($dbPosts as $post) {
        $posts[] = jcdNormalizePost($post);
      }
    }

    $dbPagination = $postsQuery->pagination();

    $pagination = (object)[
      'prev' => (object)[
        'name' => get_field('pagination_prev', 'option'),
        'url' => $dbPagination->prev['link'] ?? null
      ],
      'next' => (object)[
        'name' => get_field('pagination_next', 'option'),
        'url' => $dbPagination->next['link'] ?? null
      ]
    ];

    return (object)[
      'posts' => $posts,
      'pagination' => $pagination
    ];
  }
}
