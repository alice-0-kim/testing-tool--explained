# features/link.feature
Feature: Check link functionality UBC CLF Theme 1.0.1
  In order to check link functionality of UBC CLF Theme 1.0.1
  As an administrator
  I want to be able to check URL's when each link is clicked
   
  Scenario: Should be redirected to "/#main-content" when I click "Skip to main content"
    Given I am on "/"
    When I click "0"
    Then I should be on "/#main-content"

  Scenario: Should be redirected to "http://cdn.ubc.ca/clf/ref/aplaceofmind" when I click "UBC - A Place of Mind"
    Given I am on "/"
    When I click "11"
    Then I should be on "http://cdn.ubc.ca/clf/ref/aplaceofmind"

  Scenario: Should be redirected to "http://d8-demo.dd:8083/rss.xml" when I click "Subscribe to"
    Given I am on "/"
    When I click "17"
    Then I should be on "/rss.xml"

  Scenario: Should be redirected to "/#" when I click "Back to top"
    Given I am on "/"
    When I click "18"
    Then I should be on "/#"

  Scenario: Should be redirected to "http://cdn.ubc.ca/clf/ref/emergency" when I click "Emergency Procedures"
    Given I am on "/"
    When I click "20"
    Then I should be on "http://cdn.ubc.ca/clf/ref/emergency"

  Scenario: Should be redirected to "http://cdn.ubc.ca/clf/ref/terms" when I click "Terms of Use"
    Given I am on "/"
    When I click "21"
    Then I should be on "http://cdn.ubc.ca/clf/ref/terms"

  Scenario: Should be redirected to "http://cdn.ubc.ca/clf/ref/copyright" when I click "UBC Copyright"
    Given I am on "/"
    When I click "22"
    Then I should be on "http://cdn.ubc.ca/clf/ref/copyright"

  Scenario: Should be redirected to "http://cdn.ubc.ca/clf/ref/accessibility" when I click "Accessibility"
    Given I am on "/"
    When I click "23"
    Then I should be on "http://cdn.ubc.ca/clf/ref/accessibility"
