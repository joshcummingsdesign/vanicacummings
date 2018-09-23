<?php namespace VanicaCummings;

/**
 * Test builder normalize functions.
 */
final class TestNormalizeData extends \WP_UnitTestCase {

  /** @test */
  public function can_normalize_menus() {

    $menuData = (object)[
      'header' => (object)[
        'MenuItemClass' => (object)[],
        'PostClass' => (object)[],
        'items' => [
          (object)[
            'name' => '',
            'url' => '',
            'has_child_class' => 1,
            'classes' => [],
            'class' => '',
            'level' => 1,
            'post_name' => '',
            'PostClass' => (object)[],
            '_menu_item_object_id:protected' => 41,
            'menu_object:protected' => (object)[],
            'post_author' => '',
            'children' => [
              (object)[
                'name' => '',
                'url' => '',
                'children' => [
                  (object)[
                    'name' => '',
                    'url' => ''
                  ]
                ]
              ]
            ]
          ]
        ]
      ]
    ];

    $expected = (object)[
      'header' => (object)[
        'items' => [
          (object)[
            'name' => '',
            'url' => '',
            'children' => [
              (object)[
                'name' => '',
                'url' => '',
                'children' => [
                  (object)[
                    'name' => '',
                    'url' => ''
                  ]
                ]
              ]
            ]
          ]
        ]
      ]
    ];
    $actual = jcdNormalizeMenus($menuData);
    $this->assertEquals($expected, $actual);
  }

    /** @test */
    public function can_normalize_images() {

      $image = [
        'title' => 'foobar',
        'alt' => 'this is foobar',
        'sizes' => [
          'medium' => 800
        ]
      ];

      $expected = (object) [
        'title' => $image['title'],
        'alt' => $image['alt'],
        'sizes' => (object) [
          'medium' => $image['sizes']['medium']
        ]
      ];

      $actual = jcdNormalizeImage($image);
      $this->assertEquals($expected, $actual);
    }
}
