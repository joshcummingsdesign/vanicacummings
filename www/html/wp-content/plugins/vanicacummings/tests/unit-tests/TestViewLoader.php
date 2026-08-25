<?php namespace VanicaCummings;

use VanicaCummings\Helpers\ViewLoader as ViewLoader;

/**
 * Test the ViewLoader class.
 */
final class TestViewLoader extends \WP_UnitTestCase {

  public $data;

  public $viewLoader;

  public $locations;

  public function setUp(): void {
    parent::setUp();
    $this->data = dirname(__FILE__) . '/../data';
    $this->viewLoader = new ViewLoader('views');
    $this->locations = $this->viewLoader->getLocationPaths($this->data);
  }

  /** @test */
  public function can_get_location_paths() {

    $expected = [
      'test-subdirectory-1',
      'test-directory-2',
      'test-directory-3',
      'test-subdirectory-3'
    ];

    $actual = [];

    foreach ($this->locations as $path) {
      $location = explode('/', $path);
      $location = end($location);
      array_push($actual, $location);
    }

    $this->assertSame($expected, $actual);
  }

  /** @test */
  public function can_add_location_paths() {
    $locations = [\Timber\Loader::MAIN_NAMESPACE => ['existing']];
    $actual = $this->viewLoader->addLocationPaths($locations);
    $expected = array_merge($this->viewLoader->getLocationPaths(), ['existing']);
    $this->assertSame($expected, $actual[\Timber\Loader::MAIN_NAMESPACE]);
  }
}
