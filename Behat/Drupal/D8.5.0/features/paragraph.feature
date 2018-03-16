@api
@javascript
@paragraph
Feature: Testing Paragraph Page custom module for Drupal v8.5.0

  Scenario: Should be able to create a content type of Paragraph Page
    Given I am on "/"
    Given I am logged in as an "administrator"
    When I visit "/node/add/paragraph_page"
    Then I should see "Create Paragraph Page" with a tag name "h1"
    Then I should not see "Page not found" with a tag name "h1"

  Scenario: Should be able to select a file from local directory
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am on "/node/add/paragraph_page"
    When I click the "Choose file"
    Then I click the "Cancel"


  Scenario: Should be able to select a file from local directory
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_landing_page"
    When I click the "#edit-field-landing-feature-image-0-upload"

  @bello
  Scenario: Should be able to upload .jpg file of size 1200x600
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_landing_page"
    When I attach the file "flower_1200x600.jpg" to "#edit-field-landing-feature-image-0-upload"
    Then I should not see ".messages--error"
