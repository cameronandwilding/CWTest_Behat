<?php

/**
 *@file
 * Class MyAccountContext implements the behavior for my account pages.
 */

namespace ProjectFiles\Context;

use ProjectFiles\Util\MyAccountPage;

class MyAccountContext extends PageContext {

  //  Regions.
  const REGION_TOOLBAR = 'TOOLBAR';
  const REGION_CONTENT = 'CONTENT';

  /**
   * MyAccountPage instance.
   *
   * @var MyAccountPage
   */
  private $myAccountPage;

  /**
   * MyAccountContext constructor.
   */
  public function __construct() {
    parent::__construct();
    $this->myAccountPage = new MyAccountPage();
  }

  /**
   * @Given I visit the my account page
   */
  public function visitMyAccountPage() {
    $this->helperContext->visitPath($this->myAccountPage->getPath());
  }

  /**
   * @Given I should be logged in successfully
   */
  public function iShouldBeLoggedInSuccessfully() {
    $this->helperContext->iCanSeeInTheRegion('Manage', $this->myAccountPage->getRegion(self::REGION_TOOLBAR));
    $this->helperContext->iCanSeeTheLinkInTheRegion('View', $this->myAccountPage->getRegion(self::REGION_CONTENT));
    $this->helperContext->iCanSeeTheLinkInTheRegion('Shortcuts', $this->myAccountPage->getRegion(self::REGION_CONTENT));
    $this->helperContext->iCanSeeInTheRegion('Edit', $this->myAccountPage->getRegion(self::REGION_CONTENT));
    $this->helperContext->iCanSeeInTheRegion('Member for', $this->myAccountPage->getRegion(self::REGION_CONTENT));
  }

  /**
   * @Given I verify the my account page fields and buttons are displayed on the page
   */
  public function assertMyAccountPageStructure() {
    foreach ($this->myAccountPage->getAllRegions() as $region) {
      $this->helperContext->minkContext->assertElementOnPage($region);
    }
  }
}

