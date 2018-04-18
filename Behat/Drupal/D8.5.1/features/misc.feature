@api
@javascript
@misc
Feature: To check miscellaneous options

  Scenario: All menu items in vertical tabs should be visible
    Given I am logged in as an "administrator"
    Given I am on "/admin/appearance/settings/clf"
    Then I should see "General Settings"
    Then I should see "Unit Settings"
    Then I should see "Location and Contact Settings"
    Then I should see "Social Media Settings"
    Then I should see "Search Settings"
    Then I should see "Navigation Settings"
    Then I should see "Layout Settings"
    Then I should see "Extra Settings"
      
  Scenario: General navigation placement options should be visible
    Given I am logged in as an "administrator"
    Given I am on "/admin/appearance/settings/clf"
    When I follow "Navigation Settings"
    Then I should see "General Navigation Options"
    Then I should see "Make the default CLF navigation sticky."
    Then I should see "Primary Navigation Mobile Placement"
    Then I should see "Default CLF - Horizontal"
    Then I should see "Left Push Drawer"
    Then I should see "Right Push Drawer"
    Then I should see "Right Cover Drawer"
    Then I should not see "Right Slidein Drawer"

  Scenario: Default value of navigation placement option should be default
    Given I am logged in as an "administrator"
    Given I am on "/admin/appearance/settings/clf"
    When I follow "Navigation Settings"
    Then I see "Default CLF - Horizontal" in the "option" element with the "selected" attribute set to "true" in the "body"
    Then I am on "/"
    Then I should not see a "#drawer-button" element