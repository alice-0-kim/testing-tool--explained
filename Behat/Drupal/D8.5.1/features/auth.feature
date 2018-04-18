@auth
Feature: Authentication
  Scenario: Check response status code
    Given I am on "/"
    Then the response status code should be 200
    When I am on "/node/1"
    Then the response status code should be 200
    When I am on "/node/2"
    Then the response status code should be 404
    When I am on "/node/2"
    Then the response status code should not be 302
        
  Scenario: Response status code should be 302, page redirect
    Given I am on "https://ssc.adm.ubc.ca/sscportal/servlets/SRVSSCFramework"
    #Then the response status code should be 302
    Then I should be on "https://ssc.adm.ubc.ca/sscportal/servlets/SRVSSCFramework"
    