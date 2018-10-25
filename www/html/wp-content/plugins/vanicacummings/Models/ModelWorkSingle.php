<?php namespace VanicaCummings\Models;

/**
 * The ModelWorkSingle class.
 */
class ModelWorkSingle extends Model {

  public function getAchievements() {

    $achievements = get_field('work_achievements');

    $row = $achievements['items'];

    $items = [];

    if (!empty($row)) {

      foreach ($row as $item) {
        array_push($items, (object)[
          'caption' => $item['caption'],
          'heading' => $item['heading'],
          'text' => $item['text']
        ]);
      }
    }

    return (object)[
      'opt_heading' => $achievements['opt_heading'],
      'items' => $items
    ];
  }

  public function getAwards() {

    $awards = get_field('work_awards');

    $row = $awards['items'];

    $items = [];

    if (!empty($row)) {

      foreach ($row as $item) {
        array_push($items, (object)[
          'caption' => $item['caption'],
          'heading' => $item['heading'],
          'opt_subheading' => $item['opt_subheading'],
          'text' => $item['text']
        ]);
      }
    }

    return (object)[
      'opt_heading' => $awards['opt_heading'],
      'items' => $items
    ];
  }
}
