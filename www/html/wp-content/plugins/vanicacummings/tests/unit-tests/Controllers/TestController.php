<?php namespace VanicaCummings;

use VanicaCummings\Controllers\Controller as Controller;
use VanicaCummings\Models\BaseModel as BaseModel;

/**
 * Test the Controller class.
 */
final class TestController extends \WP_UnitTestCase {

  /**
   * The Controller class instance.
   *
   * @var object
   */
  public $controller;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->controller = new Controller();
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(BaseModel::class, $this->controller->baseModel);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $this->assertArrayHasKey('body_class', $this->controller->data);
    $this->assertArrayHasKey('is_mobile', $this->controller->data);
    $this->assertArrayHasKey('images', $this->controller->data);
    $this->assertArrayHasKey('site', $this->controller->data);
    $this->assertArrayHasKey('menus', $this->controller->data);
    $this->assertArrayHasKey('footer', $this->controller->data);
    $this->assertArrayHasKey('header', $this->controller->data);
    $this->assertArrayHasKey('sidebar', $this->controller->data);
    $this->assertArrayHasKey('posts', $this->controller->data);
    $this->assertArrayHasKey('pagination', $this->controller->data);
  }
}
