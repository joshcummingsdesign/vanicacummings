<?php namespace VanicaCummings;

use VanicaCummings\Controllers\ControllerWork as ControllerWork;
use VanicaCummings\Models\ModelWork as ModelWork;

/**
 * Test the ControllerWork class.
 */
final class TestControllerWork extends \WP_UnitTestCase {

  /**
   * The ControllerWork class instance.
   *
   * @var object
   */
  public $controller;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->controller = new ControllerWork();
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(ModelWork::class, $this->controller->model);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $this->assertArrayHasKey('templates', $this->controller->data);
    $this->assertArrayHasKey('work', $this->controller->data['templates']);
    $this->assertArrayHasKey('hero', $this->controller->data['templates']['work']);
    $this->assertArrayHasKey('content', $this->controller->data['templates']['work']);
    $this->assertArrayHasKey('three_column_image_grid', $this->controller->data['templates']['work']);
  }
}
