Feature: Login page
  In order to test the Login page
  As a variety of users
  I need to verify the page structure and functionality


#########################################################################################
###  LOGIN PAGE ACCESSIBLE
#########################################################################################

  @login @api @regression
  Scenario: Verify the login page is accessible
    Given I visit the Login page


#########################################################################################
###  VALIDATE FIELDS, BUTTONS, REGIONS
#########################################################################################

  @login @api @regression
  Scenario: Verify the structure of the login page
    Given I visit the Login page
    Then I verify the structure of the Login page


#########################################################################################
###  SUCCESSFUL LOGIN
#########################################################################################

  @login @api @regression
  Scenario: Verify a successful login
    Given I am logged in as a user with the administrator role
    Then I should be logged in successfully


#########################################################################################
###  UNSUCCESSFUL LOGIN
#########################################################################################

  @login @api @regression
  Scenario: Validation rules - missing username and password
    Given I visit the Login page
    When I press login
    Then I am still on the Login page

  @login @api @regression
  Scenario: Validation rules - missing password
    Given I visit the Login page
    And I enter the username username
    When I press login
    Then I am still on the Login page

  @login @api @regression
  Scenario: Validation rules - missing username
    Given I visit the Login page
    And I enter the password password
    When I press login
    Then I am still on the Login page

  @login @api @regression
  Scenario: Verify a failed login
    Given I visit the Login page
    When I enter the username invalid and password invalid
    And I press login
    Then I am still on the Login page
