@header
@api
@javascript
Feature: Check header region UBC CLF Theme 1.0.1
  In order to check header region of UBC CLF Theme 1.0.1
  As an administrator
  I want to be able to check rendering, functionalities, etc.

  Scenario: Check if front page unit name contains the text Demo 
    Given I am on "/"
    Then I should see the text "Demo" as the unit name

  Scenario: Should be redirected to homepage when unit name is clicked
    Given I am on "/"
    When I click the unit name "#ubc7-unit-name a"
    Then I should be on "/"

  Scenario: Should be redirected to www.ubc.ca when #ubc7-wordmark is clicked
    Given I am on "/"
    When I click the "#ubc7-wordmark a"
    Then I should be on "https://www.ubc.ca"

  Scenario: Should be redirected to www.ubc.ca when #ubc7-logo is clicked
    Given I am on "/"
    When I click the "#ubc7-logo a"
    Then I should be on "https://www.ubc.ca"

  @search
  Scenario: Should be redirected to search result page when submitted
    Given I am on "/"
    Given UBC Search is open
    Given I fill in "input[type=text]" with "computer science"
    When I click the button "#ubc7-search-box button"
    Then I should be on "https://www.ubc.ca/search"
    Then the current URL should contain search keyword "computer science"