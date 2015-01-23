Feature: I would like to edit room

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "1234"
    And I press "Login"
    And I go to "/admin/room"
    Then I should not see "<number>"
    And I follow "Create a new entry"
    Then I should see "room creation"
    When I fill in "Number" with "<number>"
    And I press "Create"
    Then I should see "<number>"

  Examples:
    | number | 
    |   11   | 
    |   22   | 
    |   33   | 


    Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "1234"
    And I press "Login"
    And I go to "/admin/room"
    Then I should not see "<new-number>"
    When I follow "<old-number>"
    Then I should see "<old-number>"
    When I follow "Edit"
    And I fill in "Number" with "<new-number>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-number>"
    And I should not see "<old-number>"

  Examples:
    | old-number | new-number               |
    | 22         | 100                      |


   Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "1234"
    And I press "Login"
    And I go to "/admin/room"
    Then I should see "<number>"
    When I follow "<number>"
    Then I should see "<number>"
    When I press "Delete"
    Then I should not see "<number>"

  Examples:
    | number   |
    |  11      |
    |  33      |
    |  100     |