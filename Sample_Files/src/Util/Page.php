<?php

/**
 * @file
 * Class Page describes the objects on general pages.
 */

namespace CWTest\Util;

/**
 * Class Page
 * @package CWTest\Util
 */
class Page {

  /**
   * @var array
   */
  public $header_regions = array(
    'HEADER_REGION' => '.header-content',
    'LOGO' => '.site-logo>a>img',
    'MENU' => '.menu',
    'MENU_ITEMS' => '.menu-item',
    'ACTIVE_MENU_ITEM' => '.is-active',
  );

  /**
   * @var array
   */
  public $footer_regions = array(
    'FOOTER_CONTAINER' => '.layout-container>footer',
    'FOOTER_REGION' => '.region.region-footer',
    'SOCIAL_LINKS' => '.footer-social-links',
    'TWITTER' => '.icon-twitter',
    'EMAIL' => '.icon-email',
    'MEETUP' => '.icon-meetup',
  );

  /**
   * Buttons.
   * @var array
   */
  private $buttons = array(
    'SAVE_AND_PUBLISH' => 'Save and publish',
    'SAVE_AS_UNPUBLISHED' => 'Save as unpublished',
    'PREVIEW' => 'Preview',
    'REMOVE' => 'Remove',
    'SAVE_AND_KEEP_PUBLISHED' => 'Save and keep published',
    'SAVE_AND_UNPUBLISH' => 'Save and unpublish',
  );
  
  /**
   * Gets all header regions.
   *
   * @return array
   */
  public function getAllHeaderRegions() {
    return $this->header_regions;
  }

  /**
   * Gets a specific header region.
   *
   * @param string $region
   * @return string
   */
  public function getHeaderRegion($region) {
    return $this->header_regions[$region];
  }

  /**
   * Gets all footer regions.
   *
   * @return array
   */
  public function getAllFooterFields() {
    return $this->footer_regions;
  }

  /**
   * Gets a specific footer region.
   *
   * @param string $region
   * @return string
   */
  public function getFooterRegion($region) {
    return $this->footer_regions[$region];
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
}