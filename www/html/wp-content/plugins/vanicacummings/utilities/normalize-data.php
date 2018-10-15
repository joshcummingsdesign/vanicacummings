<?php

/**
 * Normalize menus.
 *
 * @param object $menuData An object of Timber menu objects to normalize
 * @return object The normalized menus object
 */
function jcdNormalizeMenus($menuData) {

  $menus = (object)[];

  foreach ($menuData as $menuSlug => $menuTitle) {

    $menus->$menuSlug = (object)[
      'items' => []
    ];

    if ($menuTitle->items) {

      foreach ($menuTitle->items as $item) {

        $menuItem = (object)[
          'name' => $item->name,
          'url' => $item->url,
          'target' => $item->target === '_blank' ? '_blank' : '_self'
        ];

        array_push($menus->$menuSlug->items, $menuItem);
      }
    }
  }

  return $menus;
}

/**
 * Normalize an image by id.
 *
 * @param int $id The image ID
 */
function jcdNormalizeImage($id) {

  // Get alt text
  $alt = get_post_meta($id, '_wp_attachment_image_alt', true);

  // Create image object
  $image = (object)[
    'alt' => $alt
  ];

  // Get image sizes
  global $_wp_additional_image_sizes;
  $sizes = $_wp_additional_image_sizes;
  $sizes['full'] = [];

  // Add image sizes to image object
  foreach ($sizes as $size => $value) {
    $url = wp_get_attachment_image_src($id, $size)[0];
    $image->$size = $url;
  }

  return $image;
}

function jcdNormalizeLink($link) {
  if (empty($link)) {
    return null;
  } else {
    return (object)[
      'name' => $link['title'],
      'url' => $link['url'],
      'target' => $link['target'] === '_blank' ? '_blank' : '_self'
    ];
  }
}

function jcdNormalizePost($post) {
  return (object)[
    'title' => $post->title,
    'content' => $post->content,
    'excerpt' => $post->preview()->length(32)->read_more(false),
    'author' => $post->author ? $post->author->first_name . ' ' . $post->author->last_name : '',
    'date' => $post->date,
    'url' => $post->link,
    'image' => $post->thumbnail ? jcdNormalizeImage($post->thumbnail->id) : null
  ];
}

function jcdNormalizePeople($post, $description = 'short', $resume = false) {

  $d = get_field('person_short_description', $post->id);
  $i = get_field('person_image', $post->id);
  if ($description === 'long') {
    $d = get_field('person_long_description', $post->id);
  } elseif ($description === 'alternate') {
    $d = get_field('person_alternate_description', $post->id);
    $i = get_field('person_alternate_image', $post->id);
  }

  $r = null;
  if ($resume) {
    $r = jcdNormalizeLink(get_field('person_opt_link', $post->id));
  }

  return (object)[
    'name' => $post->title,
    'image' => jcdNormalizeImage($i),
    'title' => get_field('person_title', $post->id),
    'description' => $d,
    'opt_link' => $r,
    'twitter' => get_field('person_twitter', $post->id),
    'linkedin' => get_field('person_linkedin', $post->id),
    'email' => get_field('person_email', $post->id)
  ];
}
