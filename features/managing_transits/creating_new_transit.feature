@managing_transits
Feature: Creating a new transit
    In order to know the distance between locations of the route
    As an operator
    I want to be able to create a new route with locations

    @ui @todo
    Scenario: I want to create a new transit with 3 locations
        When I create a new transit
        And I add a "Królewska 1, Poznań, PL" locations to it
        And I add a "Legnicka 1, Wrocław, PL" locations to it
        And I add a "Fischerinsel 1, Berlin, DE" locations to it
        And I submit it
        Then I should be redirected to the transit list
        And I should see a new transit with 3 locations
