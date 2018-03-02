Feature: Check link functionality UBC CLF Theme 1.0.1
  In order to check link functionality of UBC CLF Theme 1.0.1
  As an administrator
  I want to be able to check URL's when each link is clicked

  @javascript
  Scenario: Should be redirected to "http://d8-demo.dd:8083/rss.xml" when I click "Subscribe to"
    Given I am on "/"
    When I click the link that ends with "xml"
    Then I should be on "/rss.xml"

  @javascript
  Scenario Outline: Should be redirected to a "page" when I click the link that ends with "end"
    Given I am on "/"
    When I click the link in global footer that ends with <end>
    Then I should be on <page>
    
    Examples:
      | end                       | page                                                                                                                                    |
      | contact                   | 'https://www.ubc.ca/about/contact.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'  |
      | about                     | 'https://www.ubc.ca/about/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'              |
      | news                      | 'https://www.ubc.ca/landing/news.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'   |
      | events                    | 'https://www.ubc.ca/landing/events.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F' |
      | careers                   | 'http://www.hr.ubc.ca/careers/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'    |
      | gift                      | 'https://support.ubc.ca/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'                |
      | search                    | 'https://www.ubc.ca/search/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F#gsc.tab=0'   |
      | vancouver                 | 'https://www.ubc.ca/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'                    |
      | okanagan                  | 'https://ok.ubc.ca/'                                                                                                                    |
      | robson                    | 'https://robsonsquare.ubc.ca/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'     |
      | media                     | 'https://www.thecdm.ca/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'                 |
      | medicine                  | 'http://www.med.ubc.ca/about/campuses/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'  |
      | asia                      | 'http://ubcapro.hk/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'               |

  @javascript
  Scenario Outline: Should be redirected to a "page" when I click the link that ends with "end"
    Given I am on "/"
    When I click the link in minimal footer that ends with <end>
    Then I should be on <page>
    
    Examples:
      | end                       | page                                                                                                                                                 |
      | emergency                 | 'https://www.ubc.ca/landing/emergencyprocedures.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F' |
      | terms                     | 'https://www.ubc.ca/site/legal.html?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'                  |
      | copyright                 | 'https://copyright.ubc.ca/?utm_campaign=UBC%20CLF&utm_medium=CLF%20Global%20Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'                     |
      | accessibility             | 'https://www.ubc.ca/accessibility/?utm_campaign=UBC+CLF&utm_medium=CLF+Global+Footer&utm_source=http%3A%2F%2Fd8-demo.dd%3A8083%2F'                   |
