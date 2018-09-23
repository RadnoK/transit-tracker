<?php

declare(strict_types=1);

namespace spec\TransitTracker\Application\Event;

use PhpSpec\ObjectBehavior;
use TransitTracker\Domain\Model\Id;
use TransitTracker\Domain\Model\Location;

final class LocationAddedToRouteSpec extends ObjectBehavior
{
    function it_represents_an_immutable_fact_that_a_location_has_been_added_to_the_route(): void
    {
        $routeId = Id::fromString('32bbf8c7-3e78-46ae-b7df-202f9177eba7');

        $this->beConstructedThrough('occur', [
            $routeId,
            new Location('Królewska 1, Poznań, PL'),
        ]);

        $this->routeId()->shouldBeLike(Id::fromString('32bbf8c7-3e78-46ae-b7df-202f9177eba7'));
        $this->location()->shouldBeLike(new Location('Królewska 1, Poznań, PL'));
    }
}
