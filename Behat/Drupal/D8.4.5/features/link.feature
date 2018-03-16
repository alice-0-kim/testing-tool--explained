@javascript
Feature: Check link functionality UBC CLF Theme 1.0.1
  In order to check link functionality of UBC CLF Theme 1.0.1
  As an administrator
  I want to be able to check URL's when each link is clicked

  Scenario Outline: Should be redirected to a "page" when I click the link that ends with "end"
    Given I am on "/"
    When I click the link in global footer that ends with <end>
    Then I should be on <page>
    
    Examples:
      | end                       | page                                                                                                   |
      | contact                   | 'https://www.ubc.ca/about/contact.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='  |
      | about                     | 'https://www.ubc.ca/about/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='              |
      | news                      | 'https://www.ubc.ca/landing/news.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='   |
      | events                    | 'https://www.ubc.ca/landing/events.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=' |
      | careers                   | 'http://www.hr.ubc.ca/careers/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source='    |
      | gift                      | 'https://support.ubc.ca/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                |
      | search                    | 'https://www.ubc.ca/search/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='             |
      | vancouver                 | 'https://www.ubc.ca/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                    |
      | okanagan                  | 'https://ok.ubc.ca/'                                                                                   |
      | robson                    | 'https://robsonsquare.ubc.ca/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source='     |
      | media                     | 'https://thecdm.ca/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                     |
      | medicine                  | 'http://www.med.ubc.ca/about/campuses/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='  |
      | asia                      | 'http://ubcapro.hk/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source='               |

  Scenario Outline: Should be redirected to a "page" when I click the link that ends with "end"
    Given I am on "/"
    When I click the link in minimal footer that ends with <end>
    Then I should be on <page>
    
    Examples:
      | end                       | page                                                                                                                |
      | emergency                 | 'https://www.ubc.ca/landing/emergencyprocedures.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=' |
      | terms                     | 'https://www.ubc.ca/site/legal.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                  |
      | copyright                 | 'https://copyright.ubc.ca/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source='                     |
      | accessibility             | 'https://www.ubc.ca/accessibility/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                   |
