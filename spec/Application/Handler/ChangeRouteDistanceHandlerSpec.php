<?php

declare(strict_types=1);

namespace spec\TransitTracker\Application\Handler;

use PhpSpec\ObjectBehavior;
use Prooph\ServiceBus\EventBus;
use Prophecy\Argument;
use TransitTracker\Application\Command\ChangeRouteDistance;
use TransitTracker\Application\Event\RouteDistanceChanged;
use TransitTracker\Application\Repository\Routes;
use TransitTracker\Domain\Model\Distance;
use TransitTracker\Domain\Model\Id;
use TransitTracker\Domain\Model\Route;

final class ChangeRouteDistanceHandlerSpec extends ObjectBehavior
{
    function let(Routes $routes, EventBus $eventBus): void
    {
        $this->beConstructedWith($routes, $eventBus);
    }

    function it_changes_route_distance(Routes $routes, EventBus $eventBus, Route $route): void
    {
        $routeId = Id::fromString('aa6c546c-5461-4b76-a8d1-90bfdb337b57');

        $routes->get($routeId)->willReturn($route);

        $route->changeDistance(new Distance(120));

        $routes->save()->shouldBeCalled();

        $eventBus
            ->dispatch(Argument::that(function (RouteDistanceChanged $event) use ($routeId): bool {
                return
                    $event->id() == $routeId &&
                    $event->distance() == new Distance(120)
                ;
            }))
            ->shouldBeCalled()
        ;

        $this(ChangeRouteDistance::create($routeId, new Distance(120)));
    }
}
