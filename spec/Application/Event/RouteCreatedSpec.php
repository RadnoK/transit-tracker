<?php

declare(strict_types=1);

namespace spec\TransitTracker\Application\Event;

use PhpSpec\ObjectBehavior;
use TransitTracker\Domain\Model\Id;

final class RouteCreatedSpec extends ObjectBehavior
{
    function it_represents_an_immutable_fact_that_a_route_has_been_created(): void
    {
        $routeId = Id::fromString('779c4c07-fecf-4152-b1c1-e8fa4969c756');

        $this->beConstructedThrough('occur', [$routeId, 'Route 66']);

        $this->id()->shouldBeLike($routeId);
        $this->name()->shouldReturn('Route 66');
    }
}
