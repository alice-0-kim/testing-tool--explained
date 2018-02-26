Feature: irenebae
  In order to see the text 'Irene' 
  As an anonymous user
  I want to be at path node/3 and check to see the text 'Irene' instead of 'Irean'

  Scenario: Check that the text Irene appears at path node/3
    Given I am at "node/3"
    And I am an anonymous user
    Then I should see "Irene"
    And I should not see "Irean"
