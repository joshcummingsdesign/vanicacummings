<?php namespace VanicaCummings\Controllers;

use VanicaCummings\Models\ModelPage as ModelPage;

/**
 * The ControllerPage class.
 */
class ControllerPage extends Controller {

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
    $this->model = new ModelPage();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    $this->data['header'] = $this->baseModel->getHeader();
    $this->data['post'] = $this->baseModel->getPost()->post;
    \Timber::render('t-page.twig', $this->data);
  }
}
