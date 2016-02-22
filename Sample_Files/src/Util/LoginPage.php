<?php

/**
 * @file
 * Class LoginPage describes the objects on the login page.
 */

namespace CWTest\Util;

/**
 * Class LoginPage
 * @package CWTest\Util
 */
class LoginPage extends Page {

  /**
   * The path to the Login page.
   *
   * @var string
   */
  private $path = '/user/login';

  /**
   * Fields visible on Login screen.
   *
   * @var array
   */
  private $fields = array(
    'USERNAME' => 'edit-name',
    'PASSWORD' => 'edit-pass',
  );

  /**
   * Buttons visible on Login screen.
   *
   * @var array
   */
  private $buttons = array(
    'LOG_IN' => 'edit-submit'
  );

  /**
   * Regions visible on Login screen.
   *
   * @var array
   */
  private $regions = array(
    'USER_LOGIN_FORM' => '#user-login-form'
  );

  /**
   * Message regions visible on Login screen.
   *
   * @var array
   */
  private $message_regions = array(
    'LOGIN_FAILURE' => '.messages.messages--error'
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
   * Gets all buttons.
   *
   * @return array
   */
  public function getAllButtons() {
    return $this->buttons;
  }

  /**
   * Gets a specific button.
   *
   * @param string $button
   * @return string
   */
  public function getButton($button) {
    return $this->buttons[$button];
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
   * Gets a region.
   *
   * @param string $region
   * @return string
   */
  public function getRegion($region) {
    return $this->regions[$region];
  }

  /**
   * Gets a specific message region.
   *
   * @param string $region
   * @return string
   */
  public function getMessageRegion($region) {
    return $this->message_regions[$region];
  }
}