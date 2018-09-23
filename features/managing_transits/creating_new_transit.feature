@managing_transits
Feature: Creating a new transit
    In order to know the distance between locations of the route
    As an operator
    I want to be able to create a new route with locations

    Scenario: Creating a new transit operation
        When I create a new transit named "Linia nr 66"
        And I add "r. Powstańców 1863r." destination
        And I add "Litewska" destination in a distance of 10km
        And I add "Morelowa" destination in a distance of 5km
