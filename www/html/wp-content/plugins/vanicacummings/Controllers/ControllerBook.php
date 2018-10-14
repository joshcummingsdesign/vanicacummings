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
    $this->data['templates']['book']['content'] = $model->getContent();
    $this->data['templates']['book']['testimonial_carousel'] = $model->getTestimonialCarousel();
    $this->data['templates']['book']['one_column_people_small'] = $model->getOneColumnPeopleSmall();
    $this->data['templates']['book']['call_to_action'] = $model->getCallToAction();
    $this->data['templates']['book']['trust_logos'] = $model->getTrustLogos();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    \Timber::render('t-book.twig', $this->data);
  }
}
