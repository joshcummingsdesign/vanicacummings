<?php namespace VanicaCummings\Controllers;

use VanicaCummings\Models\ModelContact as ModelContact;

/**
 * The ControllerContact class.
 */
class ControllerContact extends Controller {

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
    $model = new ModelContact();
    $this->data['templates']['contact']['hero'] = $model->getHero();
    $this->data['templates']['contact']['contact'] = $model->getContact();
    $this->data['templates']['contact']['call_to_action'] = $model->getCallToAction();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    \Timber::render('t-contact.twig', $this->data);
  }
}
