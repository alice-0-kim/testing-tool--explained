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
    
  @test
  Scenario: Should be able to add slideshow content, but should not allow image with size 600x400 to be loaded
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_paragraph_page"
    When I press "edit-preview"
    When I press "edit-submit"
    When I press "field_paragraph_content_full_width_image_add_more"
    And I wait for "5000" seconds
    When I attach "/Users/alicekim/Sites/devdesktop/D8.5.0.2/flower_600x400.jpg" to ".image-widget-data input"
    And I wait for "5000" seconds
    Then I should see the error message "Error message The specified file flower_600x400.jpg could not be uploaded. The image is too small. The minimum dimensions are 1200x450 pixels and the image size is 600x400 pixels."
    When I fill in "edit-title-0-value" with "title"
    When I press "edit-submit"
    Then I should be on "/node/add/ubc_paragraph_page"
    Then I should see the error message "Error message Image field is required."

  @wait
  Scenario: Should be able to add slideshow content, and should allow image with size 1200x600 to be loaded
    Given I am on "/"
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_paragraph_page"
    When I press "edit-preview"
    When I press "edit-submit"
    When I press "field_paragraph_content_full_width_image_add_more"
    And I wait for "5000" seconds
    When I attach "/Users/alicekim/Sites/devdesktop/D8.5.0.2/flower_1200x600.jpg" to ".image-widget-data input"
    When I fill in "edit-title-0-value" with "title"
    When I fill in "field_paragraph_content[0][subform][field_paragraph_image][0][alt]" with "alt"
    When I press "edit-submit"
    Then I should be on "/node/add/ubc_paragraph_page"
    Then I should see the error message "Error message Image field is required."
    
  @demo
  Scenario: demo purpose
    Given I am on "/"
    Then I should not see the success message "One or more problems were detected with your Drupal installation. Check the status report for more information."
    Then I should not see the error message "One or more problems were detected with your Drupal installation. Check the status report for more information."
    Given I run drush "cr"
    Then I see the ".container" element in the "header"
    Then I see the "h1" element with the "class" attribute set to "page-title" in the "content"
    Then I see "Welcome to Drupal 8.5.0" in the "h1" element with the "class" attribute set to "page-title" in the "content"
    Given I am logged in as an "administrator"
    Given I am on "/admin/config"
    Then I should see the error message "One or more problems were detected with your Drupal installation. Check the status report for more information."
    When I click "Account settings"
    Then I see "Account settings" in the "h1" element with the "class" attribute set to "page-title" in the "body"
    

