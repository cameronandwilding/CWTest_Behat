Feature: Roles and Responsibilities
  In order to test the User Roles and Responsibilities
  As a variety of users
  I need to verify the Drupal CMS permission settings


#########################################################################################
###   USER ROLES
#########################################################################################

  @api @regression @roles
  Scenario: Verify all user types
    Given users:
      | name       | mail            | roles         |
      | Admin User | admin@behat.com | administrator |


#########################################################################################
###   ANONYMOUS USER
#########################################################################################

  @roles @api @regression
  Scenario: Verify Anonymous User access to the homepage
    Given I am not logged in
    And I am on "/"
    Then I should get a 200 HTTP response

  @roles @api @regression
  Scenario: Verify Anonymous User access to /user/login
    Given I am not logged in
    And I am on "/user/login"
    Then I should get a 200 HTTP response

  @roles @api @regression
  Scenario: Verify Anonymous User access to /node/add
    Given I am not logged in
    And I am on "/node/add"
    Then I should get a 403 HTTP response

  @roles @api @regression
  Scenario: Verify Anonymous User access to /admin
    Given I am not logged in
    And I am on "/admin"
    Then I should get a 403 HTTP response

  @roles @api @regression
  Scenario: Verify Anonymous User access /user/logout
    Given I am not logged in
    And I am on "/user/logout"
    Then I should get a 403 HTTP response


#########################################################################################
###   ADMINISTRATOR
#########################################################################################

  @roles @api @regression
  Scenario: Verify Administrator access to /node/add
    Given I am logged in as a user with the administrator role
    And I am on "/node/add"
    Then I should get a 200 HTTP response

  @roles @api @regression
  Scenario: Verify Administrator access to /admin
    Given I am logged in as a user with the administrator role
    And I am on "/admin"
    Then I should get a 200 HTTP response

  @roles @api @regression
  Scenario: Verify Administrator access /user/logout
    Given I am logged in as a user with the administrator role
    And I am on "/user/logout"
    Then I should get a 200 HTTP response