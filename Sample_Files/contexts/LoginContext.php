<?php

class LoginContext extends PageContext  {

  /**
   * @var LoginPage
   */
  private $login_page;

  /**
   * LoginContext constructor.
   */
  public function __construct() {
    parent::__construct();
    $this->login_page = new LoginPage();
  }

  /**
   * @Given I visit the Login page
   */
  public function visit_login_page() {
    $this->helper_context->visitPath($this->login_page->get_path());
  }

  /**
   * @param $username
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  private function fill_username_field($username) {
    $this->helper_context->getSession()
      ->getPage()
      ->fillField($this->login_page->get_field('USERNAME'), $username);
  }

  /**
   * @param $password
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  private function fill_password_field($password) {
    $this->helper_context->getSession()
      ->getPage()
      ->fillField($this->login_page->get_field('PASSWORD'), $password);
  }

  /**
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  private function press_login_button() {
    $this->helper_context->getSession()
      ->getPage()
      ->pressButton($this->login_page->get_button('LOG_IN'));
  }

  /**
   * @Given I enter the username :username
   *
   * @param string $username
   */
  public function i_enter_a_username($username) {
    self::fill_username_field($username);
  }
  /**
   * @Given I enter the password :password
   *
   * @param string $password
   */
  public function i_enter_a_password($password) {
    self::fill_password_field($password);
  }

  /**
   * @Given I enter the username :username and password :password
   *
   * @param string $username , $password
   */
  public function i_enter_a_username_and_password($username, $password) {
    self::fill_username_field($username);
    self::fill_password_field($password);
  }


  /**
   * @Given I press login
   */
  public function i_press_the_login_button() {
    self::press_login_button();
  }

  /**
   * @Given I am still on the Login page
   */
  public function i_am_still_on_the_login_page() {
    $current_url = $this->helper_context->getSession()->getCurrentUrl();
    if (strpos($current_url, $this->login_page->get_path()) === FALSE) {
      throw new CWContextException("No longer on the Loginpage, but on {$current_url}.");
    }
  }

  /**
   * @Given I should see the login failure message
   */
  public function i_should_see_the_login_failure_message() {
    $this->helper_context->iCanSeeInTheRegion('Unrecognized username or password.', $this->login_page->get_message_region('LOGIN_FAILURE'));
    $this->helper_context->iCanSeeInTheRegion('Have you forgotten your password?', $this->login_page->get_message_region('LOGIN_FAILURE'));
  }

  /**
   * @Given I verify the structure of the Login page
   */
  public function i_verify_the_structure_of_the_login_page() {
    self::verify_fields($this->login_page->get_all_fields());
    self::verify_buttons($this->login_page->get_all_buttons());
    self::verify_regions($this->login_page->get_all_regions());
  }
}

