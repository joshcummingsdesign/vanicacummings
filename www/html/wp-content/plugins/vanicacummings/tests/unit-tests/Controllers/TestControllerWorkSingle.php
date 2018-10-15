<?php namespace VanicaCummings;

use VanicaCummings\Controllers\ControllerWorkSingle as ControllerWorkSingle;
use VanicaCummings\Models\ModelWorkSingle as ModelWorkSingle;

/**
 * Test the ControllerWorkSingle class.
 */
final class TestControllerWorkSingle extends \WP_UnitTestCase {

  /**
   * The ControllerWorkSingle class instance.
   *
   * @var object
   */
  public $controller;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->controller = new ControllerWorkSingle();
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(ModelWorkSingle::class, $this->controller->model);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $this->assertArrayHasKey('templates', $this->controller->data);
    $this->assertArrayHasKey('work_single', $this->controller->data['templates']);
    $this->assertArrayHasKey('hero', $this->controller->data['templates']['work_single']);
    $this->assertArrayHasKey('achievements', $this->controller->data['templates']['work_single']);
    $this->assertArrayHasKey('awards', $this->controller->data['templates']['work_single']);
  }
}
