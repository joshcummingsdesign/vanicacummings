<?php namespace VanicaCummings\Controllers;

use VanicaCummings\Models\ModelAbout as ModelAbout;

/**
 * The ControllerAbout class.
 */
class ControllerAbout extends Controller {

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
    $this->model = new ModelAbout();
    $this->data['templates']['about']['hero'] = $this->model->getHero();
    $this->data['templates']['about']['content'] = $this->model->getContent();
    $this->data['templates']['about']['one_column_people'] = $this->model->getOneColumnPeople();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    \Timber::render('t-about.twig', $this->data);
  }
}
