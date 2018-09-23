<?php

declare(strict_types=1);

namespace spec\TransitTracker\Application\Event;

use PhpSpec\ObjectBehavior;
use TransitTracker\Domain\Model\Distance;
use TransitTracker\Domain\Model\Id;

final class RouteDistanceChangedSpec extends ObjectBehavior
{
    function it_represents_an_immutable_fact_that_a_distance_of_the_route_has_been_changed(): void
    {
        $routeId = Id::fromString('c4eb7141-4703-4715-ba1d-0cc4ca7e22d4');

        $this->beConstructedThrough('occur', [
            $routeId,
            new Distance(120),
        ]);

        $this->id()->shouldBeLike(Id::fromString('c4eb7141-4703-4715-ba1d-0cc4ca7e22d4'));
        $this->distance()->shouldBeLike(new Distance(120));
    }
}
