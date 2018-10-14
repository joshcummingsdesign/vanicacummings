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
        array_push($cta_buttons, (object)[
          'name' => $button['link']['title'],
          'url' => $button['link']['url'],
          'target' => $button['link']['target'] === '_blank' ? '_blank' : '_self'
        ]);
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

    if (is_search()) {
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

    if (!empty($terms)) {

      foreach ($terms as $tag) {

        $slug = get_queried_object()->slug ?? null;

        array_push($tags, (object)[
          'name' => $tag->name,
          'url' => get_tag_link($tag->term_id) ?? null,
          'is_active' => $slug === $tag->slug ?? false
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
        $posts[] = (object)[
          'title' => $post->title,
          'content' => $post->post_content,
          'excerpt' => $post->preview()->length(32)->read_more(false),
          'author' => $post->author->first_name . ' ' . $post->author->last_name,
          'date' => $post->date,
          'url' => $post->link,
          'image' => jcdNormalizeImage($post->thumbnail->id)
        ];
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
