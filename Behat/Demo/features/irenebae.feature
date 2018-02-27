Feature: Assess security and accessibility
  In order to assess security and accessibility depends on roles
  	I want to make sure that anonymous user does not have access to unpublished node

  Scenario: Check that the text Irene appears in the title at path node/3
    Given I am at "node/3"
      And I am an anonymous user
    Then I should see "Irene"
      And I should not see "Irean"
      
  @api
  Scenario: Check that Administrator has access to unpublished node
    Given I am on the homepage
      And I am logged in as a user with the "administrator"
	When I visit "node/4"
	Then I should see the node title "Wendy Son"
	  And I should not see the node title "Irene Bae"
	  
  @api
  Scenario: Check that anonymous user does not have access to unpublished node
    Given I am on the homepage
      And I am not logged in
	When I visit "node/4"
	Then I should not find the node title
	  And I should see the page title "Access denied"
