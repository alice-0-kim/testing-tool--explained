@cron
Feature: Check cron status
  Scenario: Check cron is being run in a regular basis
    Given I run drush temporarily for 'watchdog-show "Cron run completed"'
    Then I save drush output