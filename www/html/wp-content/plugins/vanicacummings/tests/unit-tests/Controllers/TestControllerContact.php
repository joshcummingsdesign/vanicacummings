<?php namespace VanicaCummings;

use VanicaCummings\Controllers\ControllerContact as ControllerContact;
use VanicaCummings\Models\ModelContact as ModelContact;

/**
 * Test the ControllerContact class.
 */
final class TestControllerContact extends \WP_UnitTestCase {

  /**
   * The ControllerContact class instance.
   *
   * @var object
   */
  public $controller;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->controller = new ControllerContact();
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(ModelContact::class, $this->controller->model);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $this->assertArrayHasKey('templates', $this->controller->data);
    $this->assertArrayHasKey('contact', $this->controller->data['templates']);
    $this->assertArrayHasKey('hero', $this->controller->data['templates']['contact']);
    $this->assertArrayHasKey('contact', $this->controller->data['templates']['contact']);
    $this->assertArrayHasKey('call_to_action', $this->controller->data['templates']['contact']);
  }
}
