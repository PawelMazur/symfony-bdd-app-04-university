Feature: I would like to edit employee

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "1234"
    And I press "Login"
    And I go to "/admin/employee"
    Then I should not see "<surname>"
    And I follow "Create a new entry"
    Then I should see "Employee creation"
    When I fill in "Name" with "<name>"
    And I fill in "Surname" with "<surname>"
    And I press "Create"
    Then I should see "<surname>"

  Examples:
    | name                        | surname                 |
    | EMPLOYEE RECORD John        | EMPLOYEE RECORD Doe     |
    | EMPLOYEE RECORD Peter       | EMPLOYEE RECORD Black   |
    | EMPLOYEE RECORD Ann         | EMPLOYEE RECORD Green   |


  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "1234"
    And I press "Login"
    And I go to "/admin/employee"
    Then I should not see "<new-surname>"
    When I follow "<old-surname>"
    Then I should see "<old-surname>"
    When I follow "Edit"
    And I fill in "Name" with "<new-name>"
    And I fill in "Surname" with "<new-surname>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-surname>"
    And I should not see "<old-surname>"

  Examples:
    | old-surname         | new-name              | new-surname             |
    | EMPLOYEE RECORD Doe    | NEW EMPLOYEE RECORD Mark | NEW EMPLOYEE RECORD Nobody |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "1234"
    And I press "Login"
    And I go to "/admin/employee"
    Then I should see "<surname>"
    When I follow "<surname>"
    Then I should see "<surname>"
    When I press "Delete"
    Then I should not see "<surname>"

  Examples:
    |  surname                      |
    | EMPLOYEE RECORD Black         |
    | EMPLOYEE RECORD Green         |
    | NEW EMPLOYEE RECORD Nobody    |