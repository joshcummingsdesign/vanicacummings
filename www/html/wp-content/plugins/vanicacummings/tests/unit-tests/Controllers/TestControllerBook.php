<?php namespace VanicaCummings;

use VanicaCummings\Controllers\ControllerBook as ControllerBook;
use VanicaCummings\Models\ModelBook as ModelBook;

/**
 * Test the ControllerBook class.
 */
final class TestControllerBook extends \WP_UnitTestCase {

  /**
   * The ControllerBook class instance.
   *
   * @var object
   */
  public $controller;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->controller = new ControllerBook();
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(ModelBook::class, $this->controller->model);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $this->assertArrayHasKey('templates', $this->controller->data);
    $this->assertArrayHasKey('book', $this->controller->data['templates']);
    $this->assertArrayHasKey('hero', $this->controller->data['templates']['book']);
    $this->assertArrayHasKey('image_text', $this->controller->data['templates']['book']);
    $this->assertArrayHasKey('content', $this->controller->data['templates']['book']);
    $this->assertArrayHasKey('testimonial_carousel', $this->controller->data['templates']['book']);
    $this->assertArrayHasKey('one_column_people_small', $this->controller->data['templates']['book']);
    $this->assertArrayHasKey('call_to_action', $this->controller->data['templates']['book']);
    $this->assertArrayHasKey('trust_logos', $this->controller->data['templates']['book']);
  }
}
