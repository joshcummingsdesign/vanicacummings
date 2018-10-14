<?php namespace VanicaCummings\Controllers;

use VanicaCummings\Models\BaseModel as BaseModel;

/**
 * The Controller class.
 */
class Controller {

  /**
   * The baseModel class instance.
   *
   * @var object
   */
  public $baseModel;

  /**
   * The data to pass to the view.
   *
   * @var array
   */
  public $data = [];

  /**
   * The Controller class constructor.
   */
  public function __construct() {
    $this->baseModel = new BaseModel();
    $this->data['body_class'] = $this->baseModel->getBodyClass();
    $this->data['is_mobile'] = $this->baseModel->getIsMobile();
    $this->data['images'] = $this->baseModel->getImages();
    $this->data['site'] = $this->baseModel->getSite();
    $this->data['menus'] = $this->baseModel->getMenus();
    $this->data['footer'] = $this->baseModel->getFooter();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    $this->data['header'] = $this->baseModel->getHeader();
    $this->data['sidebar'] = $this->baseModel->getSidebar();
    $this->data['posts'] = $this->baseModel->getPosts()->posts;
    $this->data['pagination'] = $this->baseModel->getPosts()->pagination;
    \Timber::render('t-archive.twig', $this->data);
  }
}
