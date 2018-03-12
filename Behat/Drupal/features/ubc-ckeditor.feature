@api
@javascript
@ckeditor
Feature: Check UBC CKEditor Widget functionality

  @filtered
  Scenario: Should be able to see all buttons available on CKeditor in Filtered Text format
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_page"
    When I select "#edit-body-0-format--2" with "filtered_text"
    Then I should see "TOOL" in ".form-item-body-0-value" with a tag name "span":
      |         TOOL         |
      | Bold                 |
      | Italic               |
      | Link                 |
      | Unlink               |
      | CLF button           |
      | Bulleted List        |
      | Numbered List        |
      | Block Quote          |
      | Image                |
      | Accordion            |
      | Insert a card        |
      | Insert two cards     |
      | Insert three cards   |
      | Format               |
      | Styles               |
      | Insert Two Columns   |
      | Insert Three Columns |
      | Horizontal Line      |
      | Table                |
      | Paste as plain text  |
      | Maximize             |
      | Show Blocks          |
      | Source               |
    Then I should see class name "TOOL" in ".form-item-body-0-value":
      |                TOOL                |
      | .cke_button__accordiontoggle_label |
      | .cke_button__bs3-2columns_icon     |
      | .cke_button__bs3-2columns-1-2_icon |
      | .cke_button__bs3-2columns-2-1_icon |
      | .cke_button__source_label          |


  @full
  Scenario: Should be able to see all buttons available on CKeditor in Full HTML format
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_page"
    When I select "#edit-body-0-format--2" with "full_html"
    Then I should see "TOOL" in ".form-item-body-0-value" with a tag name "span":
      |         TOOL         |
      | Bold                 |
      | Italic               |
      | Strikethrough        |
      | Superscript          |
      | Subscript            |
      | Remove Format        |
      | Link                 |
      | Unlink               |
      | Bulleted List        |
      | Numbered List        |
      | Block Quote          |
      | Image                |
      | Table                |
      | Horizontal Line      |
      | Format               |
      | Show Blocks          |
      | Source               |

  @basic
  Scenario: Should be able to see all buttons available on CKeditor in Basic HTML format
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_page"
    When I select "#edit-body-0-format--2" with "basic_html"
    Then I should see "TOOL" in ".form-item-body-0-value" with a tag name "span":
      |         TOOL         |
      | Bold                 |
      | Italic               |
      | Link                 |
      | Unlink               |
      | Bulleted List        |
      | Numbered List        |
      | Block Quote          |
      | Image                |
      | Format               |
      | Source               |

  @button
  Scenario: Should see three tabs: Info, Target, Icons
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_page"
    When I select "#edit-body-0-format--2" with "filtered_text"
    And I click "CLF button" on ".form-item-body-0-value" region
    Then I should see "TAB" with a role "tab":
      |   TAB   |
      | Info    |
      | Target  |
      | Icons   |

  @button
  @temp
  Scenario: Should see the list of attributes depending on the designated tab
    Given I am logged in as an "administrator"
    Given I am on "/node/add/ubc_page"
    When I select "#edit-body-0-format--2" with "filtered_text"
    And I click "CLF button" on ".form-item-body-0-value" region
    And I click "Info" on ".cke_dialog_body" region
    Then ".cke_dialog_tab_selected" should contain the text "Info"
    And I should see "ATTRIBUTE" in ".cke_dialog_contents_body" with a tag name "td":
      |       ATTRIBUTE       |
      | Button Style          |
      | Button Text           |
      | Button Width          |
      | Button Size           |
      | Button Width          |
      | Button Link           |
      | Button Text Alignment |
    And I click "Target" on ".cke_dialog_body" region
    Then ".cke_dialog_tab_selected" should contain the text "Target"
    And I should see "ATTRIBUTE" in ".cke_dialog_contents_body" with a tag name "td":
      |       ATTRIBUTE       |
      | Link Target           |
    And I click "Icons" on ".cke_dialog_body" region
    Then ".cke_dialog_tab_selected" should contain the text "Icons"
    And I should see "ATTRIBUTE" in ".cke_dialog_contents_body" with a tag name "td":
      |       ATTRIBUTE           |
      | Add an Icon to the Button |
      | Add an optional icon      |
      | Required when using icon  |
      | Icon Alignment            |

