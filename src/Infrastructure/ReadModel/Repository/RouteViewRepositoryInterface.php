<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\ReadModel\Repository;

use TransitTracker\Infrastructure\ReadModel\View\RouteView;

interface RouteViewRepositoryInterface
{
    public function save(RouteView $routeView): void;

    public function findOneById(string $id): RouteView;

    public function findOneByName(string $name): RouteView;

    public function findAll(): array;
}
