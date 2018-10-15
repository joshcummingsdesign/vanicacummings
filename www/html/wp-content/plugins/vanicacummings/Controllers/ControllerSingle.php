<?php namespace VanicaCummings\Controllers;

use VanicaCummings\Models\ModelSingle as ModelSingle;

/**
 * The ControllerSingle class.
 */
class ControllerSingle extends Controller {

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
    $this->model = new ModelSingle();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    $this->data['header'] = $this->baseModel->getHeader();
    $this->data['sidebar'] = $this->baseModel->getSidebar();
    $this->data['post'] = $this->baseModel->getPost()->post;
    $this->data['pagination'] = $this->baseModel->getPost()->pagination;
    \Timber::render('t-single.twig', $this->data);
  }
}
