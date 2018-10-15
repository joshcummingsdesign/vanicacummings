<?php namespace VanicaCummings;

use VanicaCummings\Controllers\ControllerAbout as ControllerAbout;
use VanicaCummings\Models\ModelAbout as ModelAbout;

/**
 * Test the ControllerAbout class.
 */
final class TestControllerAbout extends \WP_UnitTestCase {

  /**
   * The ControllerAbout class instance.
   *
   * @var object
   */
  public $controller;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->controller = new ControllerAbout();
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(ModelAbout::class, $this->controller->model);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $this->assertArrayHasKey('templates', $this->controller->data);
    $this->assertArrayHasKey('about', $this->controller->data['templates']);
    $this->assertArrayHasKey('hero', $this->controller->data['templates']['about']);
    $this->assertArrayHasKey('content', $this->controller->data['templates']['about']);
    $this->assertArrayHasKey('one_column_people', $this->controller->data['templates']['about']);
  }
}
