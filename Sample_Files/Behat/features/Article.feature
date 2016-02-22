Feature: Sample page
  In order to test the Sample Content type
  As a variety of users
  I need to verify the Sample page structure and functionality


#########################################################################################
###  VALIDATE LAYOUT AND MANDATORY FIELDS
#########################################################################################

  @sample @api @javascript
  Scenario: Verify the structure of the Create Sample page
    Given I am logged in as a user with the administrator role
    And I visit the Create Sample page
    Then I verify the structure of the Create Sample page

  @sample @api @javascript
  Scenario: Verify the structure of the Edit Sample page
    Given I am logged in as a user with the administrator role
    And I visit the Create Sample page
    When I enter the following values on the Create Sample page
      | FIELD | VALUE                        |
      | TITLE | Sample Title <alpha_number> |
    And I press save and publish
    And I verify that the sample was created successfully
    When I visit the Edit Sample page
    Then I verify the structure of the Edit Sample page

  @sample @api
  Scenario: Validation rules on Create Sample
    Given I am logged in as a user with the administrator role
    And I visit the Create Sample page
    When I enter the following values on the Create Sample page
      | FIELD | VALUE |
      | TITLE |       |
    And I press save and publish
    Then I am still on the Create Sample page

  @sample @api
  Scenario: Validation rules on Edit Sample
    Given I am logged in as a user with the administrator role
    And I visit the Create Sample page
    When I enter the following values on the Create Sample page
      | FIELD | VALUE                        |
      | TITLE | Sample Title <alpha_number> |
    And I press save and publish
    And I verify that the sample was created successfully
    And I visit the Edit Sample page
    And I enter the following values on the Edit Sample page
      | FIELD | VALUE |
      | TITLE |       |
    When I press save and keep published
    Then I am still on the Edit Sample page


#########################################################################################
###  CREATE SAMPLE
#########################################################################################

  @sample @api
  Scenario: Create an Sample
    Given I am logged in as a user with the administrator role
    Then I am able to create an sample content

  @sample @api @javascript
  Scenario: Create an Sample with generic values
    Given I am logged in as a user with the administrator role
    And I visit the Create Sample page
    Then I complete the Create Sample page with generic valid data
    And I press save and publish

  @sample @api @javascript
  Scenario: Create an Sample with specified values
    Given I am logged in as a user with the administrator role
    And I visit the Create Sample page
    When I enter the following values on the Create Sample page
      | FIELD | VALUE                                 |
      | TITLE | Sample Title <alpha_number>          |
      | BODY  | This is the body text of the Sample. |
      | IMAGE | 150x350.jpg                           |
      | ALT   | ALT - 150x350.jpg                     |
    And I press save and publish
    Then I verify that the sample was created successfully


#########################################################################################
###  EDIT SAMPLE
#########################################################################################

  @sample @api
  Scenario: Edit an Sample
    Given I am logged in as a user with the administrator role
    Then I am able to edit an sample content

  @sample @api
  Scenario: Create and Edit an Sample with specified values
    Given I am logged in as a user with the administrator role
    And I visit the Create Sample page
    When I enter the following values on the Create Sample page
      | FIELD | VALUE                        |
      | TITLE | Sample Title <alpha_number> |
    And I press save and publish
    And I verify that the sample was created successfully
    Then I visit the Edit Sample page
    And I enter the following values on the Edit Sample page
      | FIELD | VALUE                               |
      | TITLE | Sample Title <alpha_number> edited |
    And I press save and keep published
    And I verify that the sample was edited successfully


#########################################################################################
###  DELETE SAMPLE
#########################################################################################

  @sample @api
  Scenario: Create and Delete an Sample with specified values
    Given I am logged in as a user with the administrator role
    And I visit the Create Sample page
    When I enter the following values on the Create Sample page
      | FIELD | VALUE                        |
      | TITLE | Sample Title <alpha_number> |
    And I press save and publish
    And I verify that the sample was created successfully
    Then I visit the Delete Sample page
    And I delete the sample
    And I verify that the sample was deleted successfully


#########################################################################################
###  VIEW SAMPLE
#########################################################################################

  @sample @api @javascript
  Scenario: Create and View an Sample with specified values
    Given I am logged in as a user with the administrator role
    And I visit the Create Sample page
    When I enter the following values on the Create Sample page
      | FIELD | VALUE                                 |
      | TITLE | Sample Title <alpha_number>          |
      | BODY  | This is the body text of the Sample. |
      | IMAGE | 150x350.jpg                           |
      | ALT   | ALT - 150x350.jpg                     |
    And I press save and publish
    Then I can see the following values on the View Sample page
      | FIELD | VALUE                                 |
      | TITLE | Sample Title <alpha_number>          |
      | BODY  | This is the body text of the Sample. |
      | IMAGE | 150x350.jpg                           |
      | ALT   | ALT - 150x350.jpg                     |
    And I verify the 'Image' assets via JS
    And I verify the 'Script' assets via JS
    And I verify the 'Hyperlink' assets via JS


#########################################################################################
###  HEADER & FOOTER
#########################################################################################

  @sample @api
  Scenario: Verify the Sample page header
    Given I am logged in as a user with the administrator role
    And I am able to create an sample content
    When I am not logged in
    And I visit the View Sample page
    Then I verify the header
    And I verify the footer