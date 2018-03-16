@api
@javascript
@nav
Feature: To check navigation options in UBC CLF Theme

  Scenario: Navigation placement option should be visible
    Given I am logged in as an "administrator"
    Given I am on "/admin/appearance/settings/clf"
    When I click "Navigation Settings" on ".vertical-tabs__menu" region
    Then I should see "#edit-clf-navigation-placement"
    And I should see "option[value='default']"
    And I should see "option[value='double']"
    And I should see "option[value='higher']"
    And I should see "option[value='slidein']"
    But I should not see "option[value='bello']"

  Scenario: Navigation sticky option should be visible
    Given I am logged in as an "administrator"
    Given I am on "/admin/appearance/settings/clf"
    When I click "Navigation Settings" on ".vertical-tabs__menu" region
    Then I should see "#edit-clf-navigation-sticky"

  Scenario: Navigation mobile placement option should be visible
    Given I am logged in as an "administrator"
    Given I am on "/admin/appearance/settings/clf"
    When I click "Navigation Settings" on ".vertical-tabs__menu" region
    Then I should see "#edit-clf-navoption"

  @yay
  Scenario: Navigation placement mode should be applied correctly
    Given I am logged in as an "administrator"
    Given I am on "/admin/appearance/settings/clf"
    When I click "Navigation Settings" on ".vertical-tabs__menu" region
    Then I should be able to check navigation mode