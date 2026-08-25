<?php namespace VanicaCummings;

use VanicaCummings\Models\BaseModel as BaseModel;

/**
 * Test the BaseModel class.
 */
final class TestBaseModel extends \WP_UnitTestCase {

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
    $this->model = new BaseModel();
  }

  /** @test */
  public function can_get_body_class() {
    $data = $this->model->getBodyClass();
    $this->assertIsString($data);
  }

  /** @test */
  public function can_get_is_mobile() {
    $data = $this->model->getIsMobile();
    $this->assertIsInt($data);
  }

  /** @test */
  public function can_get_image_path() {
    $data = $this->model->getImages();
    $this->assertIsString($data);
  }

  /** @test */
  public function can_get_site_data() {
    $data = $this->model->getSite();
    $this->assertObjectHasProperty('url', $data);
    $this->assertObjectHasProperty('language', $data);
    $this->assertObjectHasProperty('title', $data);
    $this->assertObjectHasProperty('charset', $data);
    $this->assertObjectHasProperty('menu_text', $data);
    $this->assertObjectHasProperty('none_found_text', $data);
    $this->assertObjectHasProperty('logo', $data);
  }

  /** @test */
  public function can_get_menu_data() {
    $data = $this->model->getMenus();
    $this->assertObjectHasProperty('main', $data);
    $this->assertObjectHasProperty('footer', $data);
    $this->assertObjectHasProperty('social', $data);
    $this->assertObjectHasProperty('terms', $data);
  }

  /** @test */
  public function can_get_footer_data() {
    $data = $this->model->getFooter();
    $this->assertObjectHasProperty('call_to_action', $data);
    $this->assertObjectHasProperty('heading', $data->call_to_action);
    $this->assertObjectHasProperty('buttons', $data->call_to_action);
    $this->assertObjectHasProperty('subscribe', $data);
    $this->assertObjectHasProperty('opt_border', $data->subscribe);
    $this->assertObjectHasProperty('heading', $data->subscribe);
    $this->assertObjectHasProperty('text', $data->subscribe);
    $this->assertObjectHasProperty('form', $data->subscribe);
    $this->assertObjectHasProperty('placeholder', $data->subscribe->form);
    $this->assertObjectHasProperty('button_text', $data->subscribe->form);
    $this->assertObjectHasProperty('sitemap_text', $data);
    $this->assertObjectHasProperty('contact_text', $data);
    $this->assertObjectHasProperty('social_text', $data);
    $this->assertObjectHasProperty('contact', $data);
    $this->assertObjectHasProperty('email', $data->contact);
    $this->assertObjectHasProperty('phone', $data->contact);
    $this->assertObjectHasProperty('copyright', $data);
  }

  /** @test */
  public function can_get_header_data() {
    $data = $this->model->getHeader();
    $this->assertObjectHasProperty('heading', $data);
    $this->assertObjectHasProperty('text', $data);
  }

  /** @test */
  public function can_get_sidebar_data() {
    $data = $this->model->getSidebar();
    $this->assertObjectHasProperty('text', $data);
    $this->assertObjectHasProperty('search', $data);
    $this->assertObjectHasProperty('heading', $data->search);
    $this->assertObjectHasProperty('placeholder', $data->search);
    $this->assertObjectHasProperty('button_text', $data->search);
    $this->assertObjectHasProperty('tags', $data);
    $this->assertObjectHasProperty('heading', $data->tags);
    $this->assertObjectHasProperty('items', $data->tags);
  }

  /** @test */
  public function can_get_post() {
    $id = $this->factory->post->create();
    $data = $this->model->getPost($id);
    $this->assertObjectHasProperty('post', $data);
    $this->assertObjectHasProperty('pagination', $data);
    $this->assertObjectHasProperty('prev', $data->pagination);
    $this->assertObjectHasProperty('name', $data->pagination->prev);
    $this->assertObjectHasProperty('url', $data->pagination->prev);
    $this->assertObjectHasProperty('next', $data->pagination);
    $this->assertObjectHasProperty('name', $data->pagination->next);
    $this->assertObjectHasProperty('url', $data->pagination->next);
  }

  /** @test */
  public function can_get_posts() {
    $id = $this->factory->post->create();
    $data = $this->model->getPosts();
    $this->assertObjectHasProperty('posts', $data);
    $this->assertObjectHasProperty('pagination', $data);
    $this->assertObjectHasProperty('prev', $data->pagination);
    $this->assertObjectHasProperty('name', $data->pagination->prev);
    $this->assertObjectHasProperty('url', $data->pagination->prev);
    $this->assertObjectHasProperty('next', $data->pagination);
    $this->assertObjectHasProperty('name', $data->pagination->next);
    $this->assertObjectHasProperty('url', $data->pagination->next);
  }
}
