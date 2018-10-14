<?php namespace VanicaCummings\Models;

/**
 * The ModelBook class.
 */
class ModelBook {

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
}
