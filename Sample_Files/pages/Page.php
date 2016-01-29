<?php

/**
 * @file
 * Class Page describes the objects on general pages.
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
    'ACTIVE_MENU_ITEM' => '.is-active'
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
    'MEETUP' => '.icon-meetup'
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
   * @return string
   */
  public function getFooterRegion($region) {
    return $this->footer_regions[$region];
  }
}