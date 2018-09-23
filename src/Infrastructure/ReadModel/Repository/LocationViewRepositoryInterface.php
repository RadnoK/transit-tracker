<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\ReadModel\Repository;

use TransitTracker\Infrastructure\ReadModel\View\LocationView;

interface LocationViewRepositoryInterface
{
    public function save(LocationView $locationView): void;

    public function findAll(): array;
}
