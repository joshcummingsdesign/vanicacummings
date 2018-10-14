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
