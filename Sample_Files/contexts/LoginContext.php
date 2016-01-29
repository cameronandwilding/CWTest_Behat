<?php

/**
 *@file
 * Class LoginContext implements the behavior for login pages.
 */

class LoginContext extends PageContext  {

  //  Fields.
  const FIELD_USERNAME = 'USERNAME';
  const FIELD_PASSWORD = 'PASSWORD';

  //  Buttons.
  const BUTTON_LOGIN = 'LOG_IN';


  /**
   * LoginPage instance.
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
  public function visitLoginPage() {
    $this->helper_context->visitPath($this->login_page->getPath());
  }

  /**
   * @param $username
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  private function fillUsernameField($username) {
    $this->helper_context->getSession()
      ->getPage()
      ->fillField($this->login_page->getField(self::FIELD_USERNAME), $username);
  }

  /**
   * @param $password
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  private function fillPasswordField($password) {
    $this->helper_context->getSession()
      ->getPage()
      ->fillField($this->login_page->getField(self::FIELD_PASSWORD), $password);
  }

  /**
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  private function pressLoginButton() {
    $this->helper_context->getSession()
      ->getPage()
      ->pressButton($this->login_page->getButton(self::BUTTON_LOGIN));
  }

  /**
   * @Given I enter the username :username
   *
   * @param string $username
   */
  public function iEnterAUsername($username) {
    self::fillUsernameField($username);
  }
  /**
   * @Given I enter the password :password
   *
   * @param string $password
   */
  public function iEnterAPassword($password) {
    self::fillPasswordField($password);
  }

  /**
   * @Given I enter the username :username and password :password
   *
   * @param string $username , $password
   */
  public function iEnterAUsernameAndPassword($username, $password) {
    self::fillUsernameField($username);
    self::fillPasswordField($password);
  }


  /**
   * @Given I press login
   */
  public function iPressTheLoginButton() {
    self::pressLoginButton();
  }

  /**
   * @Given I am still on the Login page
   */
  public function iAmStillOnTheLoginPage() {
    $current_url = $this->helper_context->getSession()->getCurrentUrl();
    if (strpos($current_url, $this->login_page->getPath()) === FALSE) {
      throw new CWContextException("No longer on the Loginpage, but on {$current_url}.");
    }
  }

  /**
   * @Given I should see the login failure message
   */
  public function iShouldSeeTheLoginFailureMessage() {
    $this->helper_context->iCanSeeInTheRegion('Unrecognized username or password.', $this->login_page->getMessageRegion('LOGIN_FAILURE'));
    $this->helper_context->iCanSeeInTheRegion('Have you forgotten your password?', $this->login_page->getMessageRegion('LOGIN_FAILURE'));
  }

  /**
   * @Given I verify the structure of the Login page
   */
  public function iVerifyTheStructureOfTheLoginPage() {
    self::verifyFields($this->login_page->getAllFields());
    self::verifyButtons($this->login_page->getAllButtons());
    self::verifyRegions($this->login_page->getAllRegions());
  }
}

