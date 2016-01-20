<?php

class MyAccountPage {
  /**
   * @var string $path
   */
  public $path = '/user';

  /**
   * @var array $fields
   */
  private $fields = array();

  /**
   * @var array $regions
   */
  private $regions = array(
    'HEADER' => '.header-content',
    'TOOLBAR' => '#toolbar-bar',
    'CONTENT' => '.layout-content',
    'FOOTER' => '.layout-container>footer'
  );

  /**
   * The path.
   * @return string
   */
  public function get_path() {
    return $this->path;
  }

  /**
   * All fields.
   * @return array
   */
  public function get_all_fields() {
    return $this->fields;
  }

  /**
   * A specific field.
   * @return string
   */
  public function get_field($field) {
    return $this->fields[$field];
  }

  /** All regions.
   * @return array
   */
  public function get_all_regions() {
    return $this->regions;
  }

  /**
   * A specific region.
   * @return string
   */
  public function get_region($region) {
    return $this->regions[$region];
  }
}