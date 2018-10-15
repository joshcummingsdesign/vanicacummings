<?php namespace VanicaCummings;

use VanicaCummings\Controllers\ControllerWhatWeDo as ControllerWhatWeDo;
use VanicaCummings\Models\ModelWhatWeDo as ModelWhatWeDo;

/**
 * Test the ControllerWhatWeDo class.
 */
final class TestControllerWhatWeDo extends \WP_UnitTestCase {

  /**
   * The ControllerWhatWeDo class instance.
   *
   * @var object
   */
  public $controller;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->controller = new ControllerWhatWeDo();
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(ModelWhatWeDo::class, $this->controller->model);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $this->assertArrayHasKey('templates', $this->controller->data);
    $this->assertArrayHasKey('what_we_do', $this->controller->data['templates']);
    $this->assertArrayHasKey('hero', $this->controller->data['templates']['what_we_do']);
    $this->assertArrayHasKey('content', $this->controller->data['templates']['what_we_do']);
    $this->assertArrayHasKey('text_featured', $this->controller->data['templates']['what_we_do']);
  }
}
