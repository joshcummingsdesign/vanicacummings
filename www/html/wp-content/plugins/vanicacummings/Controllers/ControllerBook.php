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
    $this->model = new ModelBook();
    $this->data['templates']['book']['hero'] = $this->model->getHero();
    $this->data['templates']['book']['image_text'] = $this->model->getImageText();
    $this->data['templates']['book']['content'] = $this->model->getContent();
    $this->data['templates']['book']['testimonial_carousel'] = $this->model->getTestimonialCarousel();
    $this->data['templates']['book']['one_column_people_small'] = $this->model->getOneColumnPeopleSmall();
    $this->data['templates']['book']['call_to_action'] = $this->model->getCallToAction();
    $this->data['templates']['book']['trust_logos'] = $this->model->getTrustLogos();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    \Timber::render('t-book.twig', $this->data);
  }
}
