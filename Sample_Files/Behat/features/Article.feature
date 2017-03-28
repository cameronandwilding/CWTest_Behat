Feature: Article page
  In order to test the Article page
  As an administrator
  I need to verify the Article page functionality

  @article @api @regression @javascript
  Scenario: Create an Article
    Given I am logged in as a user with the administrator role
    And I am on "/node/add/article"
    And I fill in "edit-title-0-value" with "Article Number One"
    And I fill in "cke_edit-body-0-value" frame with "This is some body text"
    And I fill in "edit-field-tags-target-id" with "Tag1"
    When I press "Save and publish"
    Then I should see "Article Article Number One has been created."

  @article @api @regression @javascript
  Scenario Outline: Create an Article with varied inputs
    Given I am logged in as a user with the "<User>" role
    And I am on "<URL>"
    And I fill in "edit-title-0-value" with "<Title>"
    And I fill in "cke_edit-body-0-value" frame with "<Body>"
    And I fill in "edit-field-tags-target-id" with "<Tag>"
    When I press "Save and publish"
    Then I should see "Article <Title> has been created."

    Examples:
      | User          | URL               | Title                | Body                                                 | Tag  |
      | administrator | /node/add/article | Article Number One   | This is some simple body text                        | Tag1 |
      | administrator | /node/add/article | Article Number 2     | This is some body text with numbers 123445           | Tag2 |
      | administrator | /node/add/article | Article Number Three | This is some body text with special chars - !@£$%^&* | Tag3 |