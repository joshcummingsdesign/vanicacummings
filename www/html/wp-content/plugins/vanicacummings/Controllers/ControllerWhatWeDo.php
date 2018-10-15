<?php namespace VanicaCummings\Controllers;

use VanicaCummings\Models\ModelWhatWeDo as ModelWhatWeDo;

/**
 * The ControllerWhatWeDo class.
 */
class ControllerWhatWeDo extends Controller {

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
    $this->model = new ModelWhatWeDo();
    $this->data['templates']['what_we_do']['hero'] = $this->model->getHero();
    $this->data['templates']['what_we_do']['content'] = $this->model->getContent();
    $this->data['templates']['what_we_do']['text_featured'] = $this->model->getTextFeatured();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    \Timber::render('t-what-we-do.twig', $this->data);
  }
}
