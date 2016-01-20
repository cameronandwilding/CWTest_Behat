<?php

class LoginPage extends Page {

  /**
   * The path to the Login page.
   * @var string $path
   */
  private $path = '/user/login';

  /**
   * Fields visible on Login screen.
   * @var array $fields
   */
  private $fields = array(
    'USERNAME' => 'edit-name',
    'PASSWORD' => 'edit-pass'
  );

  /**
   * Buttons visible on Login screen.
   * @var array $buttons
   */
  private $buttons = array(
    'LOG_IN' => 'edit-submit'
  );

  /**
   * Regions visible on Login screen.
   * @var array $regions
   */
  private $regions = array(
    'USER_LOGIN_FORM' => '#user-login-form'
  );

  /**
   * Message regions visible on Login screen.
   * @var array $message_regions
   */
  private $message_regions = array(
    'LOGIN_FAILURE' => '.messages.messages--error'
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

  /**
   * All buttons.
   * @return array
   */
  public function get_all_buttons() {
    return $this->buttons;
  }

  /**
   * A specific button.
   * @return string
   */
  public function get_button($button) {
    return $this->buttons[$button];
  }

  /**
   * All regions.
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

  /**
   * A specific message region.
   * @return string
   */
  public function get_message_region($region) {
    return $this->message_regions[$region];
  }
}