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
    $this->assertObjectHasAttribute('small_square', $image);
    $this->assertObjectHasAttribute('medium_square', $image);
    $this->assertObjectHasAttribute('large_square', $image);
    $this->assertObjectHasAttribute('post_thumb', $image);
    $this->assertObjectHasAttribute('large', $image);
    $this->assertObjectHasAttribute('full_width', $image);
  }

  /** @test */
  public function can_normalize_links() {
    $link = [
      'title' => 'Test',
      'url' => '#',
      'target' => ''
    ];
    $expected = (object)[
      'name' => 'Test',
      'url' => '#',
      'target' => '_self'
    ];
    $actual = jcdNormalizeLink($link);
    $this->assertEquals($expected, $actual);
  }

  /** @test */
  public function can_normalize_post() {
    $id = $this->factory->post->create();
    $post = jcdNormalizePost(new \Timber\Post($id));
    $this->assertObjectHasAttribute('title', $post);
    $this->assertObjectHasAttribute('content', $post);
    $this->assertObjectHasAttribute('excerpt', $post);
    $this->assertObjectHasAttribute('author', $post);
    $this->assertObjectHasAttribute('date', $post);
    $this->assertObjectHasAttribute('url', $post);
    $this->assertObjectHasAttribute('image', $post);
  }

  /** @test */
  public function can_normalize_people() {
    $id = $this->factory->post->create();
    $post = jcdNormalizePeople(new \Timber\Post($id));
    $this->assertObjectHasAttribute('name', $post);
    $this->assertObjectHasAttribute('image', $post);
    $this->assertObjectHasAttribute('title', $post);
    $this->assertObjectHasAttribute('description', $post);
    $this->assertObjectHasAttribute('opt_link', $post);
    $this->assertObjectHasAttribute('twitter', $post);
    $this->assertObjectHasAttribute('linkedin', $post);
    $this->assertObjectHasAttribute('email', $post);
  }
}
