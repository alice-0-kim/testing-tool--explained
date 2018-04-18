@header
@api
@javascript
Feature: Check header region

  Scenario: Should be redirected to homepage when unit name is clicked
    Given I am on "/"
    When I follow "Unit Name"
    Then I should be on "/"

  Scenario: Should be redirected to www.ubc.ca when UBC wordmark is clicked
    Given I am on "/"
    When I follow "ubc-wordmark"
    Then current url is "https://www.ubc.ca"
    
  Scenario: Should be redirected to www.ubc.ca when UBC logo is clicked
    Given I am on "/"
    When I follow "ubc-logo"
    Then current url is "https://www.ubc.ca"

  @search
  Scenario: Should be redirected to search result page when submitted
    Given I am on "/"
    Given I press "UBC Search"
    Given I fill in "q" with "computer science"
    When I press "Search"
    Then current url is "https://www.ubc.ca/search"
    Then the "search" field should contain "computer science"