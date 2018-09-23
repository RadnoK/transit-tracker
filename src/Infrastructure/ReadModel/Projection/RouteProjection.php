<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\ReadModel\Projection;

use TransitTracker\Application\Event\LocationAddedToRoute;
use TransitTracker\Application\Event\RouteCreated;
use TransitTracker\Application\Event\RouteDistanceChanged;
use TransitTracker\Infrastructure\Prooph\ApplyMethodDispatcherTrait;
use TransitTracker\Infrastructure\ReadModel\Repository\LocationViewRepositoryInterface;
use TransitTracker\Infrastructure\ReadModel\Repository\RouteViewRepositoryInterface;
use TransitTracker\Infrastructure\ReadModel\View\LocationView;
use TransitTracker\Infrastructure\ReadModel\View\RouteView;

final class RouteProjection
{
    use ApplyMethodDispatcherTrait {
        apply as __invoke;
    }

    /** @var RouteViewRepositoryInterface */
    private $routeViewRepository;

    /** @var LocationViewRepositoryInterface */
    private $locationViewRepository;

    public function __construct(
        RouteViewRepositoryInterface $routeViewRepository,
        LocationViewRepositoryInterface $locationViewRepository
    ) {
        $this->routeViewRepository = $routeViewRepository;
        $this->locationViewRepository = $locationViewRepository;
    }

    public function applyRouteCreated(RouteCreated $event): void
    {
        $routeView = new RouteView($event->id()->value(), $event->name());

        $this->routeViewRepository->save($routeView);
    }

    public function applyLocationAddedToRoute(LocationAddedToRoute $event): void
    {
        $routeView = $this->routeViewRepository->findOneById($event->routeId()->value());

        $locationView = new LocationView($routeView, $event->location()->address());

        $this->locationViewRepository->save($locationView);

        $routeView->addLocation($locationView);

        $this->routeViewRepository->save($routeView);
    }

    public function applyRouteDistanceChanged(RouteDistanceChanged $event): void
    {
        $routeView = $this->routeViewRepository->findOneById($event->id()->value());
        $routeView->setDistance($event->distance()->kilometers());

        $this->routeViewRepository->save($routeView);
    }
}
