<?php namespace VanicaCummings;

use VanicaCummings\Controllers\ControllerSingle as ControllerSingle;
use VanicaCummings\Models\ModelSingle as ModelSingle;

/**
 * Test the ControllerSingle class.
 */
final class TestControllerSingle extends \WP_UnitTestCase {

  /**
   * The ControllerSingle class instance.
   *
   * @var object
   */
  public $controller;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->controller = new ControllerSingle();
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(ModelSingle::class, $this->controller->model);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $this->assertArrayHasKey('header', $this->controller->data);
    $this->assertArrayHasKey('sidebar', $this->controller->data);
    $this->assertArrayHasKey('post', $this->controller->data);
    $this->assertArrayHasKey('pagination', $this->controller->data);
  }
}
