<?php namespace VanicaCummings;

use VanicaCummings\Models\ModelWorkSingle as ModelWorkSingle;

/**
 * Test the ModelWorkSingle class.
 */
final class TestModelWorkSingle extends \WP_UnitTestCase {

  /**
   * The model class instance.
   *
   * @var object
   */
  public $model;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->model = new ModelWorkSingle();
  }

  /** @test */
  public function can_get_achievements_data() {
    $data = $this->model->getAchievements();
    $this->assertObjectHasAttribute('opt_heading', $data);
    $this->assertObjectHasAttribute('items', $data);
  }

  /** @test */
  public function can_get_awards_data() {
    $data = $this->model->getAwards();
    $this->assertObjectHasAttribute('opt_heading', $data);
    $this->assertObjectHasAttribute('items', $data);
  }
}
