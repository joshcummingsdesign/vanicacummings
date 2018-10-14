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
    $model = new ModelWhatWeDo();
    $this->data['templates']['what_we_do']['hero'] = $model->getHero();
    $this->data['templates']['what_we_do']['content'] = $model->getContent();
    $this->data['templates']['what_we_do']['text_featured'] = $model->getTextFeatured();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    \Timber::render('t-what-we-do.twig', $this->data);
  }
}
