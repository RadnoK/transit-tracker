<?php

declare(strict_types=1);

namespace spec\TransitTracker\Application\Command;

use PhpSpec\ObjectBehavior;
use TransitTracker\Domain\Model\Id;
use TransitTracker\Domain\Model\Location;

final class AddLocationToRouteSpec extends ObjectBehavior
{
    function it_represents_an_immutable_intention_of_adding_a_location_to_the_route(): void
    {
        $routeId = Id::fromString('6ef57170-d62f-403b-bef4-53db78be2460');

        $this->beConstructedThrough('create', [
            $routeId,
            new Location('Królewska 1, Poznań, PL'),
        ]);

        $this->routeId()->shouldBeLike(Id::fromString('6ef57170-d62f-403b-bef4-53db78be2460'));
        $this->location()->shouldBeLike(new Location('Królewska 1, Poznań, PL'));
    }
}
