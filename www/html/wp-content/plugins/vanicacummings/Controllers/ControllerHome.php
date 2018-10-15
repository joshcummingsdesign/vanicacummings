<?php namespace VanicaCummings\Controllers;

use VanicaCummings\Models\ModelHome as ModelHome;

/**
 * The ControllerHome class.
 */
class ControllerHome extends Controller {

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
    $this->model= new ModelHome();
    $this->data['templates']['home']['hero'] = $this->model->getHero();
    $this->data['templates']['home']['image_text'] = $this->model->getImageText();
    $this->data['templates']['home']['four_column_image_text'] = $this->model->getFourColumnImageText();
    $this->data['templates']['home']['two_column_people'] = $this->model->getTwoColumnPeople();
    $this->data['templates']['home']['three_column_image_grid'] = $this->model->getThreeColumnImageGrid();
    $this->data['templates']['home']['testimonial_carousel'] = $this->model->getTestimonialCarousel();
    $this->data['templates']['home']['text_image_list'] = $this->model->getTextImageList();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    \Timber::render('t-home.twig', $this->data);
  }
}
