<?php

declare(strict_types=1);

namespace TransitTracker\Application\Handler;

use Prooph\ServiceBus\EventBus;
use TransitTracker\Application\Command\AddLocationToRoute;
use TransitTracker\Application\Event\LocationAddedToRoute;
use TransitTracker\Application\Repository\Routes;
use TransitTracker\Domain\Model\Route;

final class AddLocationToRouteHandler
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

    public function __invoke(AddLocationToRoute $command): void
    {
        $route = $this->routes->get($command->routeId());
        $route->addLocation($command->location());

        $this->routes->save();

        $this->eventBus->dispatch(LocationAddedToRoute::occur($command->routeId(), $command->location()));
    }
}
