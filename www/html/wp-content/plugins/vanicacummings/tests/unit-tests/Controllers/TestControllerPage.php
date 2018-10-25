<?php namespace VanicaCummings;

use VanicaCummings\Controllers\ControllerPage as ControllerPage;
use VanicaCummings\Models\ModelPage as ModelPage;

/**
 * Test the ControllerPage class.
 */
final class TestControllerPage extends \WP_UnitTestCase {

  /**
   * The ControllerPage class instance.
   *
   * @var object
   */
  public $controller;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->controller = new ControllerPage();
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(ModelPage::class, $this->controller->model);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $this->assertArrayHasKey('header', $this->controller->data);
    $this->assertArrayHasKey('post', $this->controller->data);
  }
}
