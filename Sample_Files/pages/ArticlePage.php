<?php

/**
 * @file
 * Class ArticlePage describes the objects on the article page.
 */

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
   * @return string
   */
  public function getField($field) {
    return $this->fields[$field];
  }

  /**
   * Gets all hidden fields.
   *
   * @return array
   */
  public function getAllHiddenFields() {
    return $this->hidden_fields;
  }

  /**
   * Gets a specific hidden field.
   *
   * @return string
   */
  public function getHiddenField($hidden_field) {
    return $this->hidden_fields[$hidden_field];
  }

  /**
   * Gets all create buttons.
   *
   * @return array
   */
  public function getAllCreateButtons() {
    return $this->create_buttons;
  }

  /**
   * Gets a specific create button.
   *
   * @return string
   */
  public function getCreateButton($button) {
    return $this->create_buttons[$button];
  }

  /**
   * Gets all edit buttons.
   *
   * @return array
   */
  public function getAllEditButtons() {
    return $this->edit_buttons;
  }

  /**
   * Gets a specific create button.
   *
   * @return string
   */
  public function getEditButton($button) {
    return $this->edit_buttons[$button];
  }

  /**
   * Gets a specific edit link.
   *
   * @return string
   */
  public function getEditLink($link) {
    return $this->edit_links[$link];
  }

  /**
   * Gets all edit links.
   *
   * @return array
   */
  public function getAllEditLinks() {
    return $this->edit_links;
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
   * @return string
   */
  public function getRegion($region) {
    return $this->regions[$region];
  }

  /**
   * Gets a specific message region.
   *
   * @return string
   */
  public function getMessageRegion($region) {
    return $this->message_regions[$region];
  }

  /**
   * Gets all frames.
   *
   * @return array
   */
  public function getAllFrames() {
    return $this->frames;
  }

  /**
   * Gets a specific frame.
   *
   * @return string
   */
  public function getFrame($frame) {
    return $this->frames[$frame];
  }
}