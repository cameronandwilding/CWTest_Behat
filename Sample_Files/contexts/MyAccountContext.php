<?php


class MyAccountContext extends PageContext {

  /**
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
  public function visit_my_account_page() {
    $this->helper_context->visitPath($this->my_account_page->get_path());
  }

  /**
   * @Given I should be logged in successfully
   */
  public function i_should_be_logged_in_successfully() {
    $this->helper_context->iCanSeeInTheRegion('Manage', $this->my_account_page->get_region('TOOLBAR'));
    $this->helper_context->iCanSeeTheLinkInTheRegion('View', $this->my_account_page->get_region('CONTENT'));
    $this->helper_context->iCanSeeTheLinkInTheRegion('Shortcuts', $this->my_account_page->get_region('CONTENT'));
    $this->helper_context->iCanSeeInTheRegion('Edit', $this->my_account_page->get_region('CONTENT'));
    $this->helper_context->iCanSeeInTheRegion('Member for', $this->my_account_page->get_region('CONTENT'));
  }

  /**
   * @Given I verify the my account page fields and buttons are displayed on the page
   */
  public function assert_my_account_page_structure() {
    foreach ($this->my_account_page->get_all_regions() as $region) {
      $this->helper_context->minkContext->assertElementOnPage($region);
    }
  }
}

