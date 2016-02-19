<?php

/**
 * @file
 * Class MyAccountPage describes the objects on the my account page.
 */

namespace ProjectFiles\Util;

/**
 * Class MyAccountPage
 * @package ProjectFiles\Util
 */
class MyAccountPage {
  /**
   * @var string
   */
  public $path = '/user';

  /**
   * @var array
   */
  private $fields = array();

  /**
   * @var array
   */
  private $regions = array(
    'HEADER' => '.header-content',
    'TOOLBAR' => '#toolbar-bar',
    'CONTENT' => '.layout-content',
    'FOOTER' => '.layout-container>footer',
  );

  /**
   * Gets the path.
   *
   * @return string
   */
  public function getPath() {
    return $this->path;
  }

  /**
   * Gets all fields.
   *
   * @return array
   */
  public function getAllFields() {
    return $this->fields;
  }

  /**
   * Gets a specific field.
   *
   * @param string $field
   * @return string
   */
  public function getField($field) {
    return $this->fields[$field];
  }

  /**
   * Gets all regions.
   *
   * @return array
   */
  public function getAllRegions() {
    return $this->regions;
  }

  /**
   * Gets a specific region.
   *
   * @param string $region
   * @return string
   */
  public function getRegion($region) {
    return $this->regions[$region];
  }
}