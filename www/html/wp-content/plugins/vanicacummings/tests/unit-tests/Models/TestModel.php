<?php namespace VanicaCummings;

use VanicaCummings\Models\Model as Model;

/**
 * Test the Model class.
 */
final class TestModel extends \WP_UnitTestCase {

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
    $this->model = new Model();
  }

  /** @test */
  public function can_get_hero_data() {
    $data = $this->model->getHero();
    $this->assertObjectHasProperty('bg_img', $data);
    $this->assertObjectHasProperty('heading', $data);
    $this->assertObjectHasProperty('opt_text', $data);
    $this->assertObjectHasProperty('opt_button', $data);
  }

  /** @test */
  public function can_get_image_text_data() {
    $data = $this->model->getImageText();
    $this->assertObjectHasProperty('image', $data);
    $this->assertObjectHasProperty('heading', $data);
    $this->assertObjectHasProperty('text', $data);
  }

  /** @test */
  public function can_get_content_data() {
    $data = $this->model->getContent();
    $this->assertObjectHasProperty('heading', $data);
    $this->assertObjectHasProperty('text', $data);
  }

  /** @test */
  public function can_get_text_featured_data() {
    $data = $this->model->getTextFeatured();
    $this->assertObjectHasProperty('items', $data);
  }

  /** @test */
  public function can_get_four_column_image_text_data() {
    $data = $this->model->getFourColumnImageText();
    $this->assertObjectHasProperty('opt_heading', $data);
    $this->assertObjectHasProperty('opt_text', $data);
    $this->assertObjectHasProperty('items', $data);
    $this->assertObjectHasProperty('opt_button', $data);
  }

  /** @test */
  public function can_get_one_column_people_small_data() {
    $data = $this->model->getOneColumnPeopleSmall();
    $this->assertObjectHasProperty('opt_heading', $data);
    $this->assertObjectHasProperty('people', $data);
  }

  /** @test */
  public function can_get_one_column_people_data() {
    $data = $this->model->getOneColumnPeople();
    $this->assertObjectHasProperty('opt_heading', $data);
    $this->assertObjectHasProperty('people', $data);
    $this->assertObjectHasProperty('opt_button', $data);
  }

  /** @test */
  public function can_get_two_column_people_data() {
    $data = $this->model->getTwoColumnPeople();
    $this->assertObjectHasProperty('opt_heading', $data);
    $this->assertObjectHasProperty('people', $data);
    $this->assertObjectHasProperty('opt_button', $data);
  }

  /** @test */
  public function can_get_three_column_image_grid_data() {
    $data = $this->model->getThreeColumnImageGrid();
    $this->assertObjectHasProperty('opt_style', $data);
    $this->assertObjectHasProperty('opt_heading', $data);
    $this->assertObjectHasProperty('items', $data);
    $this->assertObjectHasProperty('opt_button', $data);
  }

  /** @test */
  public function can_get_testimonial_carousel_data() {
    $data = $this->model->getTestimonialCarousel();
    $this->assertObjectHasProperty('opt_border', $data);
    $this->assertObjectHasProperty('opt_heading', $data);
    $this->assertObjectHasProperty('cards', $data);
  }

  /** @test */
  public function can_get_text_image_list_data() {
    $data = $this->model->getTextImageList();
    $this->assertObjectHasProperty('heading', $data);
    $this->assertObjectHasProperty('text', $data);
    $this->assertObjectHasProperty('image', $data);
    $this->assertObjectHasProperty('list', $data);
    $this->assertObjectHasProperty('button', $data);
  }

  /** @test */
  public function can_get_contact_data() {
    $data = $this->model->getContact();
    $this->assertObjectHasProperty('heading', $data);
    $this->assertObjectHasProperty('phone', $data);
    $this->assertObjectHasProperty('heading', $data->phone);
    $this->assertObjectHasProperty('value', $data->phone);
    $this->assertObjectHasProperty('email', $data);
    $this->assertObjectHasProperty('heading', $data->email);
    $this->assertObjectHasProperty('value', $data->email);
    $this->assertObjectHasProperty('linkedin', $data);
    $this->assertObjectHasProperty('heading', $data->linkedin);
    $this->assertObjectHasProperty('name', $data->linkedin);
    $this->assertObjectHasProperty('value', $data->linkedin);
  }

  /** @test */
  public function can_get_call_to_action_data() {
    $data = $this->model->getCallToAction();
    $this->assertObjectHasProperty('heading', $data);
    $this->assertObjectHasProperty('buttons', $data);
  }

  /** @test */
  public function can_get_trust_logos_data() {
    $data = $this->model->getTrustLogos();
    $this->assertObjectHasProperty('opt_heading', $data);
    $this->assertObjectHasProperty('logos', $data);
  }
}
