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
  public function setUp() {
    parent::setUp();
    $this->model = new BaseModel();
  }

  /** @test */
  public function can_get_body_class() {
    $data = $this->model->getBodyClass();
    $this->assertInternalType('string', $data);
  }

  /** @test */
  public function can_get_is_mobile() {
    $data = $this->model->getIsMobile();
    $this->assertInternalType('int', $data);
  }

  /** @test */
  public function can_get_image_path() {
    $data = $this->model->getImages();
    $this->assertInternalType('string', $data);
  }

  /** @test */
  public function can_get_site_data() {
    $data = $this->model->getSite();
    $this->assertObjectHasAttribute('url', $data);
    $this->assertObjectHasAttribute('language', $data);
    $this->assertObjectHasAttribute('title', $data);
    $this->assertObjectHasAttribute('charset', $data);
    $this->assertObjectHasAttribute('menu_text', $data);
    $this->assertObjectHasAttribute('none_found_text', $data);
    $this->assertObjectHasAttribute('logo', $data);
  }

  /** @test */
  public function can_get_menu_data() {
    $data = $this->model->getMenus();
    $this->assertObjectHasAttribute('main', $data);
    $this->assertObjectHasAttribute('footer', $data);
    $this->assertObjectHasAttribute('social', $data);
    $this->assertObjectHasAttribute('terms', $data);
  }

  /** @test */
  public function can_get_footer_data() {
    $data = $this->model->getFooter();
    $this->assertObjectHasAttribute('call_to_action', $data);
    $this->assertObjectHasAttribute('heading', $data->call_to_action);
    $this->assertObjectHasAttribute('buttons', $data->call_to_action);
    $this->assertObjectHasAttribute('subscribe', $data);
    $this->assertObjectHasAttribute('opt_border', $data->subscribe);
    $this->assertObjectHasAttribute('heading', $data->subscribe);
    $this->assertObjectHasAttribute('text', $data->subscribe);
    $this->assertObjectHasAttribute('form', $data->subscribe);
    $this->assertObjectHasAttribute('placeholder', $data->subscribe->form);
    $this->assertObjectHasAttribute('button_text', $data->subscribe->form);
    $this->assertObjectHasAttribute('sitemap_text', $data);
    $this->assertObjectHasAttribute('contact_text', $data);
    $this->assertObjectHasAttribute('social_text', $data);
    $this->assertObjectHasAttribute('contact', $data);
    $this->assertObjectHasAttribute('email', $data->contact);
    $this->assertObjectHasAttribute('phone', $data->contact);
    $this->assertObjectHasAttribute('copyright', $data);
  }

  /** @test */
  public function can_get_header_data() {
    $data = $this->model->getHeader();
    $this->assertObjectHasAttribute('heading', $data);
    $this->assertObjectHasAttribute('text', $data);
  }

  /** @test */
  public function can_get_sidebar_data() {
    $data = $this->model->getSidebar();
    $this->assertObjectHasAttribute('text', $data);
    $this->assertObjectHasAttribute('search', $data);
    $this->assertObjectHasAttribute('heading', $data->search);
    $this->assertObjectHasAttribute('placeholder', $data->search);
    $this->assertObjectHasAttribute('button_text', $data->search);
    $this->assertObjectHasAttribute('tags', $data);
    $this->assertObjectHasAttribute('heading', $data->tags);
    $this->assertObjectHasAttribute('items', $data->tags);
  }

  /** @test */
  public function can_get_post() {
    $id = $this->factory->post->create();
    $data = $this->model->getPost($id);
    $this->assertObjectHasAttribute('post', $data);
    $this->assertObjectHasAttribute('pagination', $data);
    $this->assertObjectHasAttribute('prev', $data->pagination);
    $this->assertObjectHasAttribute('name', $data->pagination->prev);
    $this->assertObjectHasAttribute('url', $data->pagination->prev);
    $this->assertObjectHasAttribute('next', $data->pagination);
    $this->assertObjectHasAttribute('name', $data->pagination->next);
    $this->assertObjectHasAttribute('url', $data->pagination->next);
  }

  /** @test */
  public function can_get_posts() {
    $id = $this->factory->post->create();
    $data = $this->model->getPosts();
    $this->assertObjectHasAttribute('posts', $data);
    $this->assertObjectHasAttribute('pagination', $data);
    $this->assertObjectHasAttribute('prev', $data->pagination);
    $this->assertObjectHasAttribute('name', $data->pagination->prev);
    $this->assertObjectHasAttribute('url', $data->pagination->prev);
    $this->assertObjectHasAttribute('next', $data->pagination);
    $this->assertObjectHasAttribute('name', $data->pagination->next);
    $this->assertObjectHasAttribute('url', $data->pagination->next);
  }
}
