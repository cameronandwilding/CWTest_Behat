<?php

/**
 *@file
 * Class LoginContext implements the behavior for login pages.
 */

namespace ProjectFiles\Context;

use ProjectFiles\Util\LoginPage;
use CWTest\Exception\CWContextException;

class LoginContext extends PageContext  {

  //  Fields.
  const FIELD_USERNAME = 'USERNAME';
  const FIELD_PASSWORD = 'PASSWORD';

  //  Buttons.
  const BUTTON_LOGIN = 'LOG_IN';

  //  Regions.
  const REGION_LOGIN_FAILURE = 'LOGIN_FAILURE';

  /**
   * LoginPage instance.
   *
   * @var LoginPage
   */
  private $loginPage;

  /**
   * LoginContext constructor.
   */
  public function __construct() {
    parent::__construct();
    $this->loginPage = new LoginPage();
  }

  /**
   * @Given I visit the Login page
   */
  public function visitLoginPage() {
    $this->helperContext->visitPath($this->loginPage->getPath());
  }

  /**
   * @param $username
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  private function fillUsernameField($username) {
    $this->helperContext->getSession()
      ->getPage()
      ->fillField($this->loginPage->getField(self::FIELD_USERNAME), $username);
  }

  /**
   * @param $password
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  private function fillPasswordField($password) {
    $this->helperContext->getSession()
      ->getPage()
      ->fillField($this->loginPage->getField(self::FIELD_PASSWORD), $password);
  }

  /**
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  private function pressLoginButton() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->loginPage->getButton(self::BUTTON_LOGIN));
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
    $current_url = $this->helperContext->getSession()->getCurrentUrl();
    if (strpos($current_url, $this->loginPage->getPath()) === FALSE) {
      throw new CWContextException("No longer on the Loginpage, but on {$current_url}.");
    }
  }

  /**
   * @Given I should see the login failure message
   */
  public function iShouldSeeTheLoginFailureMessage() {
    $this->helperContext->iCanSeeInTheRegion('Unrecognized username or password.', $this->loginPage->getMessageRegion(self::REGION_LOGIN_FAILURE));
    $this->helperContext->iCanSeeInTheRegion('Have you forgotten your password?', $this->loginPage->getMessageRegion(self::REGION_LOGIN_FAILURE));
  }

  /**
   * @Given I verify the structure of the Login page
   */
  public function iVerifyTheStructureOfTheLoginPage() {
    self::verifyFields($this->loginPage->getAllFields());
    self::verifyButtons($this->loginPage->getAllButtons());
    self::verifyRegions($this->loginPage->getAllRegions());
  }
}

