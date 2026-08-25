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
          new class {
            public function title() {
              return 'Test';
            }

            public function link() {
              return '#';
            }

            public function target() {
              return '';
            }
          }
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
    $this->assertObjectHasProperty('alt', $image);
    $this->assertObjectHasProperty('small_square', $image);
    $this->assertObjectHasProperty('medium_square', $image);
    $this->assertObjectHasProperty('large_square', $image);
    $this->assertObjectHasProperty('post_thumb', $image);
    $this->assertObjectHasProperty('large', $image);
    $this->assertObjectHasProperty('full_width', $image);
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
    $post = jcdNormalizePost(\Timber\Timber::get_post($id));
    $this->assertObjectHasProperty('title', $post);
    $this->assertObjectHasProperty('content', $post);
    $this->assertObjectHasProperty('excerpt', $post);
    $this->assertObjectHasProperty('author', $post);
    $this->assertObjectHasProperty('date', $post);
    $this->assertObjectHasProperty('url', $post);
    $this->assertObjectHasProperty('image', $post);
  }

  /** @test */
  public function can_normalize_people() {
    $id = $this->factory->post->create();
    $post = jcdNormalizePeople(\Timber\Timber::get_post($id));
    $this->assertObjectHasProperty('name', $post);
    $this->assertObjectHasProperty('image', $post);
    $this->assertObjectHasProperty('title', $post);
    $this->assertObjectHasProperty('description', $post);
    $this->assertObjectHasProperty('opt_link', $post);
    $this->assertObjectHasProperty('twitter', $post);
    $this->assertObjectHasProperty('linkedin', $post);
    $this->assertObjectHasProperty('email', $post);
  }
}
