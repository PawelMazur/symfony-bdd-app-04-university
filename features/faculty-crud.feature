Feature: I would like to edit faculty

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "1234"
    And I press "Login"
    And I go to "/admin/faculty"
    Then I should not see "<name>"
    And I follow "Create a new entry"
    Then I should see "faculty creation"
    When I fill in "Name" with "<name>"
    And I press "Create"
    Then I should see "<name>"

  Examples:
    | name                       | 
    | FACULTY RECORD Physics     | 
    | FACULTY RECORD Mathematics | 
    | FACULTY RECORD Biology     | 


    Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "1234"
    And I press "Login"
    And I go to "/admin/faculty"
    Then I should not see "<new-name>"
    When I follow "<old-name>"
    Then I should see "<old-name>"
    When I follow "Edit"
    And I fill in "Name" with "<new-name>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-name>"
    And I should not see "<old-name>"

  Examples:
    | old-surname                 | new-name                     |
    | FACULTY RECORD Physics      | NEW FACULTY RECORD Chemistry |


   Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "1234"
    And I press "Login"
    And I go to "/admin/faculty"
    Then I should see "<name>"
    When I follow "<name>"
    Then I should see "<name>"
    When I press "Delete"
    Then I should not see "<name>"

  Examples:
    |  surname                   |
    | FACULTY RECORD Mathematics   |
    | FACULTY RECORD Biology       |
    | NEW FACULTY RECORD Chemistry |