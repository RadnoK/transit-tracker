<?php

declare(strict_types=1);

namespace TransitTracker\Application\Handler;

use Prooph\ServiceBus\EventBus;
use TransitTracker\Application\Command\CreateRoute;
use TransitTracker\Application\Event\RouteCreated;
use TransitTracker\Application\Repository\Routes;
use TransitTracker\Domain\Model\Route;

final class CreateRouteHandler
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

    public function __invoke(CreateRoute $command): void
    {
        $route = Route::create($command->id(), $command->name());

        $this->routes->add($route);

        $this->eventBus->dispatch(RouteCreated::occur($command->id(), $command->name()));
    }
}
