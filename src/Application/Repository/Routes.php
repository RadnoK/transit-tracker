<?php

declare(strict_types=1);

namespace TransitTracker\Application\Repository;

use TransitTracker\Domain\Model\Id;
use TransitTracker\Domain\Model\Route;

interface Routes
{
    public function add(Route $route): void;

    public function get(Id $id): Route;

    public function getAll(): array;

    public function save(): void;
}
