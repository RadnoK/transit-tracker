<?php

declare(strict_types=1);

namespace spec\TransitTracker\Infrastructure\ReadModel\Projection;

use PhpSpec\ObjectBehavior;
use TransitTracker\Application\Event\LocationAddedToRoute;
use TransitTracker\Application\Event\RouteCreated;
use TransitTracker\Application\Event\RouteDistanceChanged;
use TransitTracker\Domain\Model\Distance;
use TransitTracker\Domain\Model\Id;
use TransitTracker\Domain\Model\Location;
use TransitTracker\Infrastructure\ReadModel\Projection\RouteProjection;
use TransitTracker\Infrastructure\ReadModel\Repository\RouteViewRepositoryInterface;

final class RouteProjectionSpec extends ObjectBehavior
{
    function let(RouteViewRepositoryInterface $routeViewRepository): void
    {
        $this->beConstructedWith($routeViewRepository);
    }

    function it_is_a_route_projection(): void
    {
        $this->shouldHaveType(RouteProjection::class);
    }

    function it_creates_a_route_view(RouteViewRepositoryInterface $routeViewRepository): void
    {
        $this(RouteCreated::occur(
            Id::fromString('c093ba39-78c3-4095-8dc9-fcce62e36fcd'),
            'Route 66'
        ));
    }

    function it_adds_a_location_view_to_route_view(RouteViewRepositoryInterface $routeViewRepository): void
    {
        $this(LocationAddedToRoute::occur(
            Id::fromString('ed4647ee-33ee-40a0-bd37-70ebcbfe10f8'),
            new Location('Królewska 1, Poznań, PL')
        ));
    }

    function it_changes_the_route_view_distance(RouteViewRepositoryInterface $routeViewRepository): void
    {
        $this(RouteDistanceChanged::occur(
            Id::fromString('c093ba39-78c3-4095-8dc9-fcce62e36fcd'),
            new Distance(100)
        ));
    }
}
