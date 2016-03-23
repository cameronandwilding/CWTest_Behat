<?php

/**
 * @file
 * Class PageContext implements the behavior for general pages.
 */

namespace CWTest\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use PHPUnit_Framework_Assert as Assertions;
use CWTest\Context\HelperContext;
use CWTest\Util\Page;

class PageContext implements Context {

  //  Buttons.
  const BUTTON_SAVE_AND_PUBLISH = 'SAVE_AND_PUBLISH';
  const BUTTON_SAVE_AS_UNPUBLISHED = 'SAVE_AS_UNPUBLISHED';
  const BUTTON_PREVIEW = 'PREVIEW';
  const BUTTON_SAVE_AND_KEEP_PUBLISHED = 'SAVE_AND_KEEP_PUBLISHED';
  const BUTTON_SAVE_AND_UNPUBLISH = 'SAVE_AND_UNPUBLISH';

  /**
   * @var HelperContext
   */
  public $helperContext;

  /**
   * Page instance.
   * @var Page
   */
  private $page;

  /**
   * PageContext constructor.
   */
  public function __construct() {
    $this->page = new Page();
  }

  /**
   * @BeforeScenario
   *
   * Allow access to the HelperContext.
   */
  public function gatherContexts(BeforeScenarioScope $scope) {
    $environment = $scope->getEnvironment();
    $this->helperContext = $environment->getContext('CWTest\Context\HelperContext');
  }

  /**
   * Verify the fields displayed on the screen.
   * @param $fields
   */
  protected function verifyFields($fields) {
    foreach ($fields as $field) {
      Assertions::assertTrue($this->helperContext->getSession()
        ->getPage()
        ->hasField($field), $field . ' field not found');
    }
  }

  /**
   * Verify the frames displayed on the screen.
   * @param $frames
   */
  protected function verifyFrames($frames) {
    foreach ($frames as $frame) {
      Assertions::assertTrue($this->helperContext->hasFrame($frame), $frame . ' frame not found');
    }
  }

  /**
   * Verify the buttons displayed on the screen.
   * @param $buttons
   */
  protected function verifyButtons($buttons) {
    foreach ($buttons as $button) {
      Assertions::assertTrue($this->helperContext->getSession()
        ->getPage()
        ->hasButton($button), $button . ' button not found');
    }
  }

  /**
   * Verify the regions displayed on the screen.
   * @param $regions
   */
  protected function verifyRegions($regions) {
    foreach ($regions as $region) {
      $this->helperContext->minkContext->assertElementOnPage($region);
    }
  }

  /**
   * Verify the links displayed on the screen.
   * @param $links
   */
  protected function verifyLinks($links) {
    foreach ($links as $link) {
      Assertions::assertTrue($this->helperContext->getSession()
        ->getPage()
        ->hasLink($link), $link . ' link not found');
    }
  }

  /**
   * Verify the header.
   */
  protected function verifyHeader() {
    $header_regions = $this->page->getAllHeaderRegions();
    self::verifyRegions($header_regions);
  }

  /**
   * Verify the footer.
   */
  protected function verifyFooter() {
    $footer_regions = $this->page->getAllHeaderRegions();
    self::verifyRegions($footer_regions);
  }

  /**
   * Press the SAVE AND PUBLISH button
   */
  protected function pressSaveAndPublish() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->page->getButton(self::BUTTON_SAVE_AND_PUBLISH));
  }

  /**
   * Press the SAVE AS UNPUBLISHED button.
   */
  protected function pressSaveAsUnpublished() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->page->getButton(self::BUTTON_SAVE_AS_UNPUBLISHED));
  }

  /**
   * Press the PREVIEW button.
   */
  protected function pressPreview() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->page->getButton(self::BUTTON_PREVIEW));
  }
  
  /**
   * Press the SAVE AND KEEP PUBLISHED button.
   */
  protected function pressSaveAndKeepPublished() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->page->getButton(self::BUTTON_SAVE_AND_KEEP_PUBLISHED));
  }

  /**
   * Press the SAVE AND UNPUBLISH button.
   */
  protected function pressSaveAndUnpublish() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->page->getButton(self::BUTTON_SAVE_AND_UNPUBLISH));
  }
}

