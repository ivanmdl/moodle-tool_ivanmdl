@tool_ivanmdl
Feature: Verify that editing is working

  Background:
    And the following "courses" exist:
      | fullname    | shortname | format |
      | Course Ivan | CIS       | weeks  |
    And the following "course enrolments" exist:
      | user     | course  | role                      |
      | admin    | CIS     | editingteacher            |

#  @javascript
  Scenario: I can add entry in plugin and see it in table
    Given I log in as "admin"
#    When I am on the "My courses" page
#    And I wait until the page is ready
    And I am on "Course Ivan" course homepage
    And I navigate to "My first Moodle plugin" in current page administration
    And I press "Add entry"
    And I set the following fields to these values:
      | Insert name      | Entry Ivan Mdl |
      | Completed        | 1              |
    And I press "Save changes"
    Then the following should exist in the "tool_ivanmdl_table" table:
      | Name            | Completed   |
      | Entry Ivan Mdl  | 1           |




