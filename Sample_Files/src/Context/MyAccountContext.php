<?php

/**
 *@file
 * Class MyAccountContext tests the behaviour of the My Account page.
 */

namespace CWTest\Context;

class MyAccountContext extends PageContext {

  //  Regions.
  const REGION_CONTENT = '#content';

  /**
   * The path to the My Account page.
   * @var string
   */
  private $path = '/user';

  /**
   * MyAccountContext constructor.
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * @Given I visit the my account page
   */
  public function visitMyAccountPage() {
    $this->helperContext->visitPath($this->path);
  }

  /**
   * @Given I should be logged in successfully
   */
  public function iShouldBeLoggedInSuccessfully() {
    $this->helperContext->iCanSeeTheLinkInTheRegion('View', self::REGION_CONTENT);
    $this->helperContext->iCanSeeInTheRegion('Edit', self::REGION_CONTENT);
    $this->helperContext->iCanSeeInTheRegion('Member for', self::REGION_CONTENT);
  }

  /**
   * @Given I verify the my account page fields and buttons are displayed on the page
   */
  public function assertMyAccountPageStructure() {
    $this->helperContext->minkContext->assertElementOnPage(self::REGION_CONTENT);
  }
}