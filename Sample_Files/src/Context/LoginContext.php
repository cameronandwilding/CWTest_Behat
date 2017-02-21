<?php

/**
 *@file
 * Class LoginContext tests the behaviour of the login page.
 */

namespace CWTest\Context;

use CWTest\Exception\CWContextException;

class LoginContext extends PageContext  {

  //  Fields.
  const FIELD_USERNAME = 'edit-name';
  const FIELD_PASSWORD = 'edit-pass';

  //  Buttons.
  const BUTTON_LOGIN = 'edit-submit';

  // Regions.
  const REGION_USERNAME_DESCRIPTION = '#edit-name--description';
  const REGION_PASSWORD_DESCRIPTION = '#edit-pass--description';

  /**
   * The path to the Login page.
   * @var string
   */
  private $path = '/user/login';

  /**
   * LoginContext constructor.
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * @Given I visit the Login page
   */
  public function visitLoginPage() {
    $this->helperContext->visitPath($this->path);
  }

  /**
   * @Given I enter the username :username
   *
   * @param string $username
   */
  public function iEnterAUsername($username) {
    $this->helperContext->getSession()
      ->getPage()
      ->fillField(self::FIELD_USERNAME, $username);
  }
  /**
   * @Given I enter the password :password
   *
   * @param string $password
   */
  public function iEnterAPassword($password) {
    $this->helperContext->getSession()
      ->getPage()
      ->fillField(self::FIELD_PASSWORD, $password);
  }

  /**
   * @Given I enter the username :username and password :password
   *
   * @param string $username
   * @param string $password
   */
  public function iEnterAUsernameAndPassword($username, $password) {
    $this->helperContext->getSession()
      ->getPage()
      ->fillField(self::FIELD_USERNAME, $username);
    $this->helperContext->getSession()
      ->getPage()
      ->fillField(self::FIELD_PASSWORD, $password);
  }

  /**
   * @Given I press login
   */
  public function iPressTheLoginButton() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton(self::BUTTON_LOGIN);
  }

  /**
   * @Given I am still on the Login page
   */
  public function iAmStillOnTheLoginPage() {
    $current_url = $this->helperContext->getSession()->getCurrentUrl();
    if (strpos($current_url, $this->path) === FALSE) {
      throw new CWContextException("No longer on the Loginpage, but on {$current_url}.");
    }
  }

  /**
   * @Given I verify the structure of the Login page
   */
  public function iVerifyTheStructureOfTheLoginPage() {
    $this->verifyField(self::FIELD_USERNAME);
    $this->verifyField(self::FIELD_PASSWORD);
    $this->verifyButton(self::BUTTON_LOGIN);
  }
}