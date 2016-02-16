Feature: Article page
  In order to test the Article Content type
  As a variety of users
  I need to verify the Article page structure and functionality


#########################################################################################
###  VALIDATE LAYOUT AND MANDATORY FIELDS
#########################################################################################

  @article @api @regression @javascript
  Scenario: Verify the structure of the Create Article page
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    Then I verify the structure of the Create Article page

  @article @api @regression @javascript
  Scenario: Verify the structure of the Edit Article page
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE                        |
      | TITLE | Article Title <alpha_number> |
    And I press save and publish
    And I verify that the article was created successfully
    When I visit the Edit Article page
    Then I verify the structure of the Edit Article page

  @article @api @regression
  Scenario: Validation rules on Create Article
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE |
      | TITLE |       |
    And I press save and publish
    Then I am still on the Create Article page

  @article @api @regression
  Scenario: Validation rules on Edit Article
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE                        |
      | TITLE | Article Title <alpha_number> |
    And I press save and publish
    And I verify that the article was created successfully
    And I visit the Edit Article page
    And I enter the following values on the Edit Article page
      | FIELD | VALUE |
      | TITLE |       |
    When I press save and keep published
    Then I am still on the Edit Article page


#########################################################################################
###  CREATE ARTICLE
#########################################################################################

  @article @api @smoke
  Scenario: Create an Article
    Given I am logged in as a user with the administrator role
    Then I am able to create an article content

  @article @api @regression @javascript
  Scenario: Create an Article with generic values
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    Then I complete the Create Article page with generic valid data
    And I press save and publish

  @article @api @regression @javascript
  Scenario: Create an Article with specified values
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE                                 |
      | TITLE | Article Title <alpha_number>          |
      | BODY  | This is the body text of the Article. |
      | IMAGE | 150x350.jpg                           |
      | ALT   | ALT - 150x350.jpg                     |
    And I press save and publish
    Then I verify that the article was created successfully


#########################################################################################
###  EDIT ARTICLE
#########################################################################################

  @article @api @smoke
  Scenario: Edit an Article
    Given I am logged in as a user with the administrator role
    Then I am able to edit an article content

  @article @api @regression
  Scenario: Create and Edit an Article with specified values
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE                        |
      | TITLE | Article Title <alpha_number> |
    And I press save and publish
    And I verify that the article was created successfully
    Then I visit the Edit Article page
    And I enter the following values on the Edit Article page
      | FIELD | VALUE                               |
      | TITLE | Article Title <alpha_number> edited |
    And I press save and keep published
    And I verify that the article was edited successfully


#########################################################################################
###  DELETE ARTICLE
#########################################################################################

  @article @api @regression
  Scenario: Create and Delete an Article with specified values
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE                        |
      | TITLE | Article Title <alpha_number> |
    And I press save and publish
    And I verify that the article was created successfully
    Then I visit the Delete Article page
    And I delete the article
    And I verify that the article was deleted successfully


#########################################################################################
###  VIEW ARTICLE
#########################################################################################

  @article @api @regression @javascript
  Scenario: Create and View an Article with specified values
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE                                 |
      | TITLE | Article Title <alpha_number>          |
      | BODY  | This is the body text of the Article. |
      | IMAGE | 150x350.jpg                           |
      | ALT   | ALT - 150x350.jpg                     |
    And I press save and publish
    Then I can see the following values on the View Article page
      | FIELD | VALUE                                 |
      | TITLE | Article Title <alpha_number>          |
      | BODY  | This is the body text of the Article. |
      | IMAGE | 150x350.jpg                           |
      | ALT   | ALT - 150x350.jpg                     |
    And I verify the 'Image' assets via JS
    And I verify the 'Script' assets via JS
    And I verify the 'Hyperlink' assets via JS


#########################################################################################
###  HEADER & FOOTER
#########################################################################################

  @article @api @regression @bm
  Scenario: Verify the Article page header
    Given I am logged in as a user with the administrator role
    And I am able to create an article content
    When I am not logged in
    And I visit the View Article page
    Then I verify the header
    And I verify the footer