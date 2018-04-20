@shib
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
  @ajax
  @javascript
  Scenario: Successful login process
    Given I am on "https://example.site.com/login"
    Then I must be on "https://page.redirected.site.com/login"
    When I fill in "username" with "username"
    When I fill in "password" with "password"
    When I press "Continue"
    Then I must be on "https://example.site.com/welcome"
  @javascript
  Scenario: Should send an email when the argument == true
  	Given I am on "/path?arg=true"
  	Then I should see "A test e-mail has been sent to test@example.com via SMTP." in the "region"
