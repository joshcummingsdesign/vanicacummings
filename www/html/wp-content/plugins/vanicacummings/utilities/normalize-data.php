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
          'children' => []
        ];

        if ($item->children) {

          foreach ($item->children as $child) {

            $childItem = (object)[
              'name' => $child->name,
              'url' => $child->url,
              'children' => []
            ];

            if ($child->children) {

              foreach ($child->children as $grandchild) {

                $grandchildItem = (object)[
                  'name' => $child->name,
                  'url' => $child->url
                ];

                  array_push($childItem->children, $grandchildItem);
              }
            }

            array_push($menuItem->children, $childItem);
          }
        }

        array_push($menus->$menuSlug->items, $menuItem);
      }
    }
  }

  return $menus;
}

function jcdNormalizeImage($image) {

  if (!($image)) {
    return null;
  }
  return (object) [
    'title' => $image['title'],
    'alt' => $image['alt'],
    'sizes' => (object)[
      'medium' => $image['sizes']['medium']
    ]
  ];
}
