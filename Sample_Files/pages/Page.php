<?php

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
   * All header regions.
   * @return array
   */
  public function get_all_header_regions() {
    return $this->header_regions;
  }

  /**
   * A specific header region.
   * @return string
   */
  public function get_header_region($region) {
    return $this->header_regions[$region];
  }

  /**
   * All footer regions.
   * @return array
   */
  public function get_all_footer_fields() {
    return $this->footer_regions;
  }

  /**
   * A specific footer region.
   * @return string
   */
  public function get_footer_region($region) {
    return $this->footer_regions[$region];
  }
}