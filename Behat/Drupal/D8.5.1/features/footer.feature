@footer
@api
@javascript
Feature: Check footer region

  Scenario: Should be redirected to www.ubc.ca when UBC signature is clicked
    Given I am on "/"
    When I follow "ubc-signature"
    Then current url is "https://www.ubc.ca"
    
  Scenario Outline: Should be redirected to a page when I click a link
    Given I am on "/"
    When I follow <link>
    Then current url is <page>
    
    Examples:
      | link                                 | page                                                                                                                |
      | "Contact UBC"                        | 'https://www.ubc.ca/about/contact.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='               |
      | "About the University"               | 'https://www.ubc.ca/about/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                           |
      | "News"                               | 'https://www.ubc.ca/landing/news.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                |
      | "Events"                             | 'https://www.ubc.ca/landing/events.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='              |
      | "Careers"                            | 'http://www.hr.ubc.ca/careers/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source='                 |
      | "Make a Gift"                        | 'https://support.ubc.ca/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                             |
      | "Search UBC.ca"                      | 'https://www.ubc.ca/search/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                          |
      | "Vancouver Campus"                   | 'https://www.ubc.ca/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                                 |
      | "Okanagan Campus"                    | 'https://ok.ubc.ca/'                                                                                                |
      | "Robson Square"                      | 'https://robsonsquare.ubc.ca/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source='                  |
      | "Centre for Digital Media"           | 'https://thecdm.ca/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                                  |
      | "Faculty of Medicine Across BC"      | 'http://www.med.ubc.ca/about/campuses/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='               |
      | "Asia Pacific Regional Office"       | 'http://ubcapro.hk/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source='                            |
      | "Emergency Procedures"               | 'https://www.ubc.ca/landing/emergencyprocedures.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=' |
      | "Terms of Use"                       | 'https://www.ubc.ca/site/legal.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                  |
      | "UBC Copyright"                      | 'https://copyright.ubc.ca/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source='                     |
      | "Accessibility"                      | 'https://www.ubc.ca/accessibility/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source='                   |