Feature: Check UBC Drupal 8 Configuration Module
  As an admin, I want to be able to create and have access to contents of type Announcement, Landing Page, and Page.
  As a user, I want to see Announcements on menu tab as default.

  @announcement
  @javascript
  Scenario: Should have /announcements on menu tab titled Announcements
    Given I am an anonymous user
    And I am on "/"
    Then "#ubc7-unit-menu" should contain "Announcements"

  @announcement
  @javascript
  Scenario: Should be redirected to /announcements when Announcements is clicked
    Given I am an anonymous user
    And I am on "/"
    When I click "Announcements" on "#ubc7-unit-menu" region
    Then I should be on "/announcements"

  @api
  @announcement
  @javascript
  Scenario: Should be able to create a content type of Announcement
    Given I am logged in as an "administrator"
    When I visit "/node/add/ubc_announcement"
    Then I should be on "/node/add/ubc_announcement"
    And I should see "Create Announcement" with a tag name "h1"
    And I should not see "Page not found" with a tag name "h1"

  @api
  @landing
  @javascript
  Scenario: Should be able to create a content type of Landing page
    Given I am logged in as an "administrator"
    When I visit "/node/add/ubc_landing_page"
    Then I should be on "/node/add/ubc_landing_page"
    And I should see "Create Landing Page" with a tag name "h1"
    And I should not see "Page not found" with a tag name "h1"

  @api
  @javascript
  Scenario: Should be redirected to Page not found page
    Given I am logged in as an "administrator"
    When I visit "/node/add/not_a_real_content_type"
    Then I should be on "/node/add/not_a_real_content_type"
    And I should see "Page not found" with a tag name "h1"
