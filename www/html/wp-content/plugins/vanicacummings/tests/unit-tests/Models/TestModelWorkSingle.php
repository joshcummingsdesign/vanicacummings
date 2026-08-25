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
  public function setUp(): void {
    parent::setUp();
    $this->model = new ModelWorkSingle();
  }

  /** @test */
  public function can_get_achievements_data() {
    $data = $this->model->getAchievements();
    $this->assertObjectHasProperty('opt_heading', $data);
    $this->assertObjectHasProperty('items', $data);
  }

  /** @test */
  public function can_get_awards_data() {
    $data = $this->model->getAwards();
    $this->assertObjectHasProperty('opt_heading', $data);
    $this->assertObjectHasProperty('items', $data);
  }
}
