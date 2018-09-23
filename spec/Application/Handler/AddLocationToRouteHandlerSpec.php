<?php

declare(strict_types=1);

namespace spec\TransitTracker\Application\Handler;

use PhpSpec\ObjectBehavior;
use Prooph\ServiceBus\EventBus;
use Prophecy\Argument;
use TransitTracker\Application\Command\AddLocationToRoute;
use TransitTracker\Application\Event\LocationAddedToRoute;
use TransitTracker\Application\Repository\Routes;
use TransitTracker\Domain\Model\Id;
use TransitTracker\Domain\Model\Location;
use TransitTracker\Domain\Model\Route;

final class AddLocationToRouteHandlerSpec extends ObjectBehavior
{
    function let(Routes $routes, EventBus $eventBus): void
    {
        $this->beConstructedWith($routes, $eventBus);
    }

    function it_adds_locations_to_route(Routes $routes, EventBus $eventBus, Route $route): void
    {
        $routeId = Id::fromString('2354d8a4-6130-4364-827b-c8509bf1289e');

        $routes->get($routeId)->willReturn($route);

        $route->addLocation(new Location('Królewska 1, Poznań, PL'));

        $routes->save()->shouldBeCalled();

        $eventBus
            ->dispatch(Argument::that(function (LocationAddedToRoute $event) use ($routeId): bool {
                return
                    $event->routeId() == $routeId &&
                    $event->location() == new Location('Królewska 1, Poznań, PL')
                ;
            }))
            ->shouldBeCalled()
        ;

        $this(AddLocationToRoute::create($routeId, new Location('Królewska 1, Poznań, PL')));
    }
}
