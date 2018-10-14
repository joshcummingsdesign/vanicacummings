<?php namespace VanicaCummings\Models;

/**
 * The ModelHome class.
 */
class ModelHome {

  public function getHero() {
    return jcdNormalizeHero();
  }

  public function getImageText() {
    return (object)[
      'image' => jcdNormalizeImage(get_field('image_text_image')),
      'heading' => get_field('image_text_heading'),
      'text' => get_field('image_text_text')
    ];
  }

  public function getFourColumnImageText() {

    $row = get_field('four_column_image_text_items');

    $items = [];

    if (!empty($row)) {

      foreach ($row as $item) {
        array_push($items, (object)[
          'image' => jcdNormalizeImage($item['image']),
          'heading' => $item['heading'],
          'text' => $item['text']
        ]);
      }
    }

    return (object)[
      'opt_heading' => get_field('four_column_image_text_opt_heading'),
      'opt_text' => get_field('four_column_image_text_opt_text'),
      'items' => $items,
      'opt_button' => jcdNormalizeLink(get_field('four_column_image_text_opt_button'))
    ];
  }

  public function getTwoColumnPeople() {

    $postsQuery = new \Timber\PostQuery(['post_type' => 'person']);

    $dbPosts = $postsQuery->get_posts();

    $people = [];

    $description = get_field('two_column_people_description_length');

    $resume = get_field('two_column_people_show_resume');

    if (!empty($dbPosts)) {

      foreach ($dbPosts as $post) {
        $people[] = jcdNormalizePeople($post, $description, $resume);
      }
    }

    return (object)[
      'opt_heading' => get_field('two_column_people_opt_heading'),
      'people' => $people,
      'opt_button' => jcdNormalizeLink(get_field('two_column_people_opt_button'))
    ];
  }

  public function getThreeColumnImageGrid() {

    $postsQuery = new \Timber\PostQuery(['post_type' => 'work']);

    $dbPosts = $postsQuery->get_posts();

    $items = [];

    if (!empty($dbPosts)) {

      foreach ($dbPosts as $post) {
        $items[] = (object)[
          'opt_heading' => $post->title,
          'image' => jcdNormalizeImage(get_field('work_image_thumbnail', $post->id)),
          'opt_link' => (object)[
            'url' => $post->link,
            'target' => '_self'
          ]
        ];
      }
    }

    return (object)[
      'opt_heading' => get_field('three_column_image_grid_opt_heading'),
      'items' => $items,
      'opt_button' => jcdNormalizeLink(get_field('three_column_image_grid_opt_button'))
    ];
  }

  public function getTestimonialCarousel() {

    $row = get_field('testimonial_carousel_items');

    $cards = [];

    if (!empty($row)) {

      foreach ($row as $card) {
        array_push($cards, (object)[
          'image' => jcdNormalizeImage($card['image']),
          'text' => $card['text'],
          'name' => $card['name'],
          'title' => $card['title']
        ]);
      }
    }

    return (object)[
      'opt_border' => true,
      'opt_heading' => get_field('testimonial_carousel_opt_heading'),
      'cards' => $cards
    ];
  }

  public function getTextImageList() {

    $row = get_field('text_image_list_list');

    $list = [];

    if (!empty($row)) {

      foreach ($row as $item) {
        array_push($list, $item['list_item']);
      }
    }

    return (object)[
      'heading' => get_field('text_image_list_heading'),
      'text' => get_field('text_image_list_text'),
      'image' => jcdNormalizeImage(get_field('text_image_list_image')),
      'list' => $list,
      'button' => jcdNormalizeLink(get_field('text_image_list_button'))
    ];
  }
}
