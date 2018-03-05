Feature: Check theme setting page UBC CLF Theme 1.0.1
  In order to check theme setting page of UBC CLF Theme 1.0.1
  As an administrator
  I want to be able to check rendering, functionalities, etc.

  @api
  @admin
  @javascript
  Scenario: Should have access to admin/appearance page 
    Given I am on "/"
    Given I am logged in as an "administrator"
    When I visit "/admin/appearance"
    Then I should be on "/admin/appearance"
    And I should see "Appearance" with a tag name "h1"

  @api
  @admin
  @javascript
  @temp
  Scenario: Should be default theme 
    Given I am logged in as an "administrator"
    And I am on "/admin/appearance"
    Then ".theme-default" should contain "CLF"

  @api
  @admin
  @javascript
  @temp
  Scenario: Should be redirected to admin/appearance/settings/clf when I click settings
    Given I am logged in as an "administrator"
    And I am on "/admin/appearance"
    When I click the link that ends with "clf" in the ".theme-default" region
    Then I should be on "/admin/appearance/settings/clf"
    And I should see "CLF" with a tag name "h1"

  @api
  @admin
  @javascript
  Scenario: Should see all menu items in vertical tabs
    Given I am logged in as an "administrator"
    And I am on "/admin/appearance/settings/clf"
    Then I should see "settings" in ".vertical-tabs__menu":
      | settings                      |
      | General Settings              |
      | Unit Settings                 |
      | Location and Contact Settings |
      | Social Media Settings         |
      | Search Settings               |
      | Navigation Settings           |
      | Layout Settings               |
      | Extra Settings                |
