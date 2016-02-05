<?php

/**
 *@file
 * Class MyAccountContext implements the behavior for my account pages.
 */

class MyAccountContext extends PageContext {

  //  Regions.
  const REGION_TOOLBAR = 'TOOLBAR';
  const REGION_CONTENT = 'CONTENT';

  /**
   * MyAccountPage instance.
   *
   * @var MyAccountPage
   */
  private $my_account_page;

  /**
   * MyAccountContext constructor.
   */
  public function __construct() {
    parent::__construct();
    $this->my_account_page = new MyAccountPage();
  }

  /**
   * @Given I visit the my account page
   */
  public function visitMyAccountPage() {
    $this->helper_context->visitPath($this->my_account_page->getPath());
  }

  /**
   * @Given I should be logged in successfully
   */
  public function iShouldBeLoggedInSuccessfully() {
    $this->helper_context->iCanSeeInTheRegion('Manage', $this->my_account_page->getRegion(self::REGION_TOOLBAR));
    $this->helper_context->iCanSeeTheLinkInTheRegion('View', $this->my_account_page->getRegion(self::REGION_CONTENT));
    $this->helper_context->iCanSeeTheLinkInTheRegion('Shortcuts', $this->my_account_page->getRegion(self::REGION_CONTENT));
    $this->helper_context->iCanSeeInTheRegion('Edit', $this->my_account_page->getRegion(self::REGION_CONTENT));
    $this->helper_context->iCanSeeInTheRegion('Member for', $this->my_account_page->getRegion(self::REGION_CONTENT));
  }

  /**
   * @Given I verify the my account page fields and buttons are displayed on the page
   */
  public function assertMyAccountPageStructure() {
    foreach ($this->my_account_page->getAllRegions() as $region) {
      $this->helper_context->minkContext->assertElementOnPage($region);
    }
  }
}

