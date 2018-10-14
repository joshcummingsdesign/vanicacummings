<?php namespace VanicaCummings\Controllers;

use VanicaCummings\Models\ModelBook as ModelBook;

/**
 * The ControllerBook class.
 */
class ControllerBook extends Controller {

  /**
   * The model class instance.
   *
   * @var object
   */
  public $model;

  /**
   * The Controller class constructor.
   */
  public function __construct() {
    parent::__construct();
    $model = new ModelBook();
    $this->data['templates']['book']['hero'] = $model->getHero();
    $this->data['templates']['book']['image_text'] = $model->getImageText();
    $this->data['templates']['book']['testimonial_carousel'] = $model->getTestimonialCarousel();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    \Timber::render('t-book.twig', $this->data);
  }
}
