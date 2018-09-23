<?php

declare(strict_types=1);

namespace TransitTracker\Application\Handler;

use Prooph\ServiceBus\EventBus;
use TransitTracker\Application\Command\ChangeRouteDistance;
use TransitTracker\Application\Event\RouteDistanceChanged;
use TransitTracker\Application\Repository\Routes;

final class ChangeRouteDistanceHandler
{
    /** @var Routes */
    private $routes;

    /** @var EventBus */
    private $eventBus;

    public function __construct(Routes $routes, EventBus $eventBus)
    {
        $this->routes = $routes;
        $this->eventBus = $eventBus;
    }

    public function __invoke(ChangeRouteDistance $command): void
    {
        $route = $this->routes->get($command->id());
        $route->changeDistance($command->distance());

        $this->routes->save();

        $this->eventBus->dispatch(RouteDistanceChanged::occur($command->id(), $command->distance()));
    }
}
