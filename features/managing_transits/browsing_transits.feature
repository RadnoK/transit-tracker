@managing_transits
Feature: Browsing all available transits
    In order to see all available routes
    As an operator
    I want to be able to list all transits

    @api
    Scenario: Browsing all available transits
        When I browse all transits
        Then I should see all available transits
