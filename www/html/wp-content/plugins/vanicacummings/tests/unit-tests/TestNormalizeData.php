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
            'name' => 'Test',
            'url' => '#',
            'has_child_class' => 1,
            'classes' => [],
            'class' => '',
            'level' => 1,
            'post_name' => '',
            'PostClass' => (object)[],
            '_menu_item_object_id:protected' => 41,
            'menu_object:protected' => (object)[],
            'post_author' => '',
            'target' => ''
          ]
        ]
      ]
    ];

    $expected = (object)[
      'header' => (object)[
        'items' => [
          (object)[
            'name' => 'Test',
            'url' => '#',
            'target' => '_self'
          ]
        ]
      ]
    ];
    $actual = jcdNormalizeMenus($menuData);
    $this->assertEquals($expected, $actual);
  }

  /** @test */
  public function can_normalize_images() {
    $image = jcdNormalizeImage(1);
    $this->assertObjectHasAttribute('alt', $image);
    $this->assertObjectHasAttribute('medium', $image);
    $this->assertObjectHasAttribute('full', $image);
  }
}
