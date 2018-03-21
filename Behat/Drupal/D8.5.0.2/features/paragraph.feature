@api
@javascript
Feature: Testing UBC Paragraph Page Content Type

  Scenario: Should be able to log in as an administrator, and log out
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am not logged in
    Then I should be on "/"
    
  @exclude
  Scenario: Should be able to create a content type of Paragraph Page
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I create node "ubc_paragraph_page" with the title "Bello"
    Then I should be on "/node/1"

  Scenario: Should be able to create a content type of Paragraph Page
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_paragraph_page"
    Then ".page-title" is visible that says "Create Paragraph page"

  Scenario: Should be able to see label in <strong>
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_paragraph_page"
    Then "#edit-field-paragraph-content strong" is visible that says "Content"
        
  Scenario: Should be able to see description in <em>
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_paragraph_page"
    Then "#edit-field-paragraph-content-text em" is visible that says "No Paragraph added yet."

  Scenario: Should be able to see dropdown menu
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_paragraph_page"
    Then "#edit-field-paragraph-content-wrapper .dropbutton-widget" is visible that says ""

  Scenario: Should be able to see all four options in dropdown menu
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_paragraph_page"
    Then "#edit-field-paragraph-content-wrapper .dropbutton-widget" is visible that says ""
    Then "options" are visible that say "value":
    | options                                                                 | value                  |
    | #edit-field-paragraph-content-add-more-add-more-button-full-width-image | "Add Full Width Image" |
    | #edit-field-paragraph-content-add-more-add-more-button-image-gallery    | "Add Image Gallery"    |
    | #edit-field-paragraph-content-add-more-add-more-button-slideshow        | "Add Slideshow"        |
    | #edit-field-paragraph-content-add-more-add-more-button-text             | "Add Text"             |
    
  @include
  Scenario: Should be able to see all four options in dropdown menu
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_paragraph_page"
    When I click ".breadcrumb ol li a"
    Then I am not logged in
    Then I should be on "/"


