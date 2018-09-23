<?php

declare(strict_types=1);

namespace spec\TransitTracker\Application\Command;

use PhpSpec\ObjectBehavior;
use TransitTracker\Domain\Model\Distance;
use TransitTracker\Domain\Model\Id;

final class ChangeRouteDistanceSpec extends ObjectBehavior
{
    function it_represents_an_immutable_intention_of_changing_the_distance_of_the_route(): void
    {
        $routeId = Id::fromString('e7b58698-cc81-4e20-b700-5d8f94e8563c');

        $this->beConstructedThrough('create', [
            $routeId,
            new Distance(120),
        ]);

        $this->id()->shouldBeLike(Id::fromString('e7b58698-cc81-4e20-b700-5d8f94e8563c'));
        $this->distance()->shouldBeLike(new Distance(120));
    }
}
