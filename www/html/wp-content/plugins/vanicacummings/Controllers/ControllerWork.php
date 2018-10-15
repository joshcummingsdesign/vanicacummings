<?php namespace VanicaCummings\Controllers;

use VanicaCummings\Models\ModelWork as ModelWork;

/**
 * The ControllerWork class.
 */
class ControllerWork extends Controller {

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
    $this->model = new ModelWork();
    $this->data['templates']['work']['hero'] = $this->model->getHero();
    $this->data['templates']['work']['content'] = $this->model->getContent();
    $this->data['templates']['work']['three_column_image_grid'] = $this->model->getThreeColumnImageGrid();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    \Timber::render('t-work.twig', $this->data);
  }
}
