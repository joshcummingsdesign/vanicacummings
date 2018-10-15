<?php namespace VanicaCummings\Controllers;

use VanicaCummings\Models\ModelWorkSingle as ModelWorkSingle;

/**
 * The ControllerWorkSingle class.
 */
class ControllerWorkSingle extends Controller {

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
    $this->model = new ModelWorkSingle();
    $this->data['templates']['work_single']['hero'] = $this->model->getHero();
    $this->data['templates']['work_single']['achievements'] = $this->model->getAchievements();
    $this->data['templates']['work_single']['awards'] = $this->model->getAwards();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    $this->data['pagination'] = $this->baseModel->getPost()->pagination;
    \Timber::render('t-work-single.twig', $this->data);
  }
}
