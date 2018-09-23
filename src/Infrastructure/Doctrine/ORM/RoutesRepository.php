<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\Doctrine\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use TransitTracker\Application\Exception\RouteNotFoundException;
use TransitTracker\Application\Repository\Routes;
use TransitTracker\Domain\Model\Id;
use TransitTracker\Domain\Model\Route;

final class RoutesRepository implements Routes
{
    /** @var ObjectManager */
    private $objectManager;

    /** @var ObjectRepository */
    private $routeRepository;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->routeRepository = $this->objectManager->getRepository(Route::class);
    }

    public function add(Route $route): void
    {
        $this->objectManager->persist($route);
        $this->objectManager->flush();
    }

    public function get(Id $id): Route
    {
        $route = $this->routeRepository->find($id);

        if (null === $route) {
            throw new RouteNotFoundException();
        }

        return $route;
    }

    public function getAll(): array
    {
        return $this->routeRepository->findAll();
    }

    public function save(): void
    {
        $this->objectManager->flush();
    }
}
