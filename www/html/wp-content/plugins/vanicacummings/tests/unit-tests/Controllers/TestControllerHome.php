<?php namespace VanicaCummings;

use VanicaCummings\Controllers\ControllerHome as ControllerHome;
use VanicaCummings\Models\ModelHome as ModelHome;

/**
 * Test the ControllerHome class.
 */
final class TestControllerHome extends \WP_UnitTestCase {

  /**
   * The ControllerHome class instance.
   *
   * @var object
   */
  public $controller;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->controller = new ControllerHome();
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(ModelHome::class, $this->controller->model);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $this->assertArrayHasKey('templates', $this->controller->data);
    $this->assertArrayHasKey('home', $this->controller->data['templates']);
    $this->assertArrayHasKey('hero', $this->controller->data['templates']['home']);
    $this->assertArrayHasKey('image_text', $this->controller->data['templates']['home']);
    $this->assertArrayHasKey('four_column_image_text', $this->controller->data['templates']['home']);
    $this->assertArrayHasKey('two_column_people', $this->controller->data['templates']['home']);
    $this->assertArrayHasKey('three_column_image_grid', $this->controller->data['templates']['home']);
    $this->assertArrayHasKey('testimonial_carousel', $this->controller->data['templates']['home']);
    $this->assertArrayHasKey('text_image_list', $this->controller->data['templates']['home']);
  }
}
