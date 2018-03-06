@api
@javascript
@node
Feature: Check ability to create, edit nodes
  As an admin, I want to be able to create and have access to contents of type Announcement, Landing Page, and Page.
  @announcement
  Scenario: Should be able to create nodes of type Announcement
    Given I am logged in as an "administrator"
    When I create "ubc_announcement" with the following:
      |         id         | value |
      | edit-title-0-value | A001  |
      | edit-title-0-value | A002  |
      | edit-title-0-value | A003  |
    And I visit "/announcements"
    Then I should see "announcements" in ".view-content":
      | announcements |
      | A001 |
      | A002 |
      | A003 |

  @landing
  Scenario: Should be able to create nodes of type Landing Page
    Given I am logged in as an "administrator"
    When I create "ubc_landing_page" with the following:
      |         id         | value |
      | edit-title-0-value | L001  |
      | edit-title-0-value | L002  |
      | edit-title-0-value | L003  |
