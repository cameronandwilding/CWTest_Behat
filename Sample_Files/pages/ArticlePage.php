<?php

class ArticlePage {

  /**
   * The path to the Article Content Type.
   * @var string $path
   */
  private $path = '/node/add/article';

  /**
   * Fields visble in Create and Edit mode.
   * @var array $fields
   */
  private $fields = array(
    'TITLE' => 'edit-title-0-value',
    'IMAGE' => 'edit-field-image-0-upload'
  );

  /**
   * Fields hidden in Create and Edit mode.
   * @var array $hidden_fields
   */
  private $hidden_fields = array(
    'ALT' => 'edit-field-image-0-alt'
  );

  /**
   * Frames available in Create and Edit mode.
   * @var array $frames
   */
  private $frames = array(
    'BODY' => 'cke_edit-body-0-value'
  );

  /**
   * Buttons visible in Create mode.
   * @var array $create_buttons
   */
  private $create_buttons = array(
    'SAVE_AND_PUBLISH' => 'Save and publish',
    'SAVE_AS_UNPUBLISHED' => 'Save as unpublished',
    'PREVIEW' => 'Preview'
  );

  /**
   * Buttons visible in Edit mode.
   * @var array $edit_buttons
   */
  private $edit_buttons = array(
    'REMOVE' => 'Remove',
    'SAVE_AND_KEEP_PUBLISHED' => 'Save and keep published',
    'SAVE_AND_UNPUBLISH' => 'Save and unpublish',
    'PREVIEW' => 'Preview'
  );

  /**
   * Links visible in Edit mode.
   * @var array $edit_buttons
   */
  private $edit_links = array(
    'DELETE' => 'Delete'
  );

  /**
   * Content regions visible in View mode.
   * @var array $view_regions
   */
  private $regions = array(
    'VIEW_TITLE' => '.field--name-title',
    'VIEW_BODY' => '.layout-content-wrapper',
    'VIEW_IMAGE' => '.image-style-large'
  );

  /**
   * Message regions in View mode.
   * @var array $message_regions
   */
  private $message_regions = array(
    'SUCCESS_MESSAGE_REGION' => '.messages.messages--status'
  );

  /**
   * The path to the Article Content type.
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
   * All hidden fields.
   * @return array
   */
  public function get_all_hidden_fields() {
    return $this->hidden_fields;
  }

  /**
   * A specific hidden field.
   * @return string
   */
  public function get_hidden_field($hidden_field) {
    return $this->hidden_fields[$hidden_field];
  }

  /**
   * All create buttons.
   * @return array
   */
  public function get_all_create_buttons() {
    return $this->create_buttons;
  }

  /**
   * A specific create button.
   * @return string
   */
  public function get_create_button($button) {
    return $this->create_buttons[$button];
  }

  /**
   * All edit buttons.
   * @return array
   */
  public function get_all_edit_buttons() {
    return $this->edit_buttons;
  }

  /**
   * A specific create button.
   * @return string
   */
  public function get_edit_button($button) {
    return $this->edit_buttons[$button];
  }

  /**
   * A specific edit link.
   * @return string
   */
  public function get_edit_link($link) {
    return $this->edit_links[$link];
  }

  /**
   * All edit links.
   * @return array
   */
  public function get_all_edit_links() {
    return $this->edit_links;
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

  /**
   * All frames.
   * @return array
   */
  public function get_all_frames() {
    return $this->frames;
  }

  /**
   * A specific frame.
   * @return string
   */
  public function get_frame($frame) {
    return $this->frames[$frame];
  }
}