<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\Doctrine\ORM;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use TransitTracker\Infrastructure\Exception\RouteViewNotFoundException;
use TransitTracker\Infrastructure\ReadModel\Repository\RouteViewRepositoryInterface;
use TransitTracker\Infrastructure\ReadModel\View\RouteView;

final class RouteViewRepository implements RouteViewRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $objectManager;

    /** @var ObjectRepository */
    private $objectRepository;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->objectRepository = $objectManager->getRepository(RouteView::class);
    }

    public function save(RouteView $routeView): void
    {
        $this->objectManager->persist($routeView);
        $this->objectManager->flush();
    }

    public function findOneById(string $id): RouteView
    {
        /** @var RouteView $routeView */
        $routeView = $this->objectRepository->find($id);

        if (null === $routeView) {
            throw new RouteViewNotFoundException();
        }

        return $routeView;
    }

    public function findOneByName(string $name): RouteView
    {
        /** @var RouteView $routeView */
        $routeView = $this->objectRepository->findOneBy(['name' => $name]);

        if (null === $routeView) {
            throw new RouteViewNotFoundException();
        }

        return $routeView;
    }

    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }
}
