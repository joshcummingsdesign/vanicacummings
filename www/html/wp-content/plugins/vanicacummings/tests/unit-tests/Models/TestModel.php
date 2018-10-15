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
  public function setUp() {
    parent::setUp();
    $this->model = new Model();
  }

  /** @test */
  public function can_get_hero_data() {
    $data = $this->model->getHero();
    $this->assertObjectHasAttribute('bg_img', $data);
    $this->assertObjectHasAttribute('heading', $data);
    $this->assertObjectHasAttribute('opt_text', $data);
    $this->assertObjectHasAttribute('opt_button', $data);
  }

  /** @test */
  public function can_get_image_text_data() {
    $data = $this->model->getImageText();
    $this->assertObjectHasAttribute('image', $data);
    $this->assertObjectHasAttribute('heading', $data);
    $this->assertObjectHasAttribute('text', $data);
  }

  /** @test */
  public function can_get_content_data() {
    $data = $this->model->getContent();
    $this->assertObjectHasAttribute('heading', $data);
    $this->assertObjectHasAttribute('text', $data);
  }

  /** @test */
  public function can_get_text_featured_data() {
    $data = $this->model->getTextFeatured();
    $this->assertObjectHasAttribute('items', $data);
  }

  /** @test */
  public function can_get_four_column_image_text_data() {
    $data = $this->model->getFourColumnImageText();
    $this->assertObjectHasAttribute('opt_heading', $data);
    $this->assertObjectHasAttribute('opt_text', $data);
    $this->assertObjectHasAttribute('items', $data);
    $this->assertObjectHasAttribute('opt_button', $data);
  }

  /** @test */
  public function can_get_one_column_people_small_data() {
    $data = $this->model->getOneColumnPeopleSmall();
    $this->assertObjectHasAttribute('opt_heading', $data);
    $this->assertObjectHasAttribute('people', $data);
  }

  /** @test */
  public function can_get_one_column_people_data() {
    $data = $this->model->getOneColumnPeople();
    $this->assertObjectHasAttribute('opt_heading', $data);
    $this->assertObjectHasAttribute('people', $data);
    $this->assertObjectHasAttribute('opt_button', $data);
  }

  /** @test */
  public function can_get_two_column_people_data() {
    $data = $this->model->getTwoColumnPeople();
    $this->assertObjectHasAttribute('opt_heading', $data);
    $this->assertObjectHasAttribute('people', $data);
    $this->assertObjectHasAttribute('opt_button', $data);
  }

  /** @test */
  public function can_get_three_column_image_grid_data() {
    $data = $this->model->getThreeColumnImageGrid();
    $this->assertObjectHasAttribute('opt_style', $data);
    $this->assertObjectHasAttribute('opt_heading', $data);
    $this->assertObjectHasAttribute('items', $data);
    $this->assertObjectHasAttribute('opt_button', $data);
  }

  /** @test */
  public function can_get_testimonial_carousel_data() {
    $data = $this->model->getTestimonialCarousel();
    $this->assertObjectHasAttribute('opt_border', $data);
    $this->assertObjectHasAttribute('opt_heading', $data);
    $this->assertObjectHasAttribute('cards', $data);
  }

  /** @test */
  public function can_get_text_image_list_data() {
    $data = $this->model->getTextImageList();
    $this->assertObjectHasAttribute('heading', $data);
    $this->assertObjectHasAttribute('text', $data);
    $this->assertObjectHasAttribute('image', $data);
    $this->assertObjectHasAttribute('list', $data);
    $this->assertObjectHasAttribute('button', $data);
  }

  /** @test */
  public function can_get_contact_data() {
    $data = $this->model->getContact();
    $this->assertObjectHasAttribute('heading', $data);
    $this->assertObjectHasAttribute('phone', $data);
    $this->assertObjectHasAttribute('heading', $data->phone);
    $this->assertObjectHasAttribute('value', $data->phone);
    $this->assertObjectHasAttribute('email', $data);
    $this->assertObjectHasAttribute('heading', $data->email);
    $this->assertObjectHasAttribute('value', $data->email);
    $this->assertObjectHasAttribute('linkedin', $data);
    $this->assertObjectHasAttribute('heading', $data->linkedin);
    $this->assertObjectHasAttribute('name', $data->linkedin);
    $this->assertObjectHasAttribute('value', $data->linkedin);
  }

  /** @test */
  public function can_get_call_to_action_data() {
    $data = $this->model->getCallToAction();
    $this->assertObjectHasAttribute('heading', $data);
    $this->assertObjectHasAttribute('buttons', $data);
  }

  /** @test */
  public function can_get_trust_logos_data() {
    $data = $this->model->getTrustLogos();
    $this->assertObjectHasAttribute('opt_heading', $data);
    $this->assertObjectHasAttribute('logos', $data);
  }
}
