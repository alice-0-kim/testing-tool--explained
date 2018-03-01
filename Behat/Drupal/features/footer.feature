# features/footer.feature
Feature: Check footer region UBC CLF Theme 1.0.1
  In order to check footer region of UBC CLF Theme 1.0.1
  As an administrator
  I want to be able to check rendering, functionalities, etc.
   
  Scenario: Should be redirected to www.ubc.ca when #ubc7-signature is clicked
    Given I am on "/"
    When I click the "#ubc7-signature a"
    Then I should be on "https://www.ubc.ca"
