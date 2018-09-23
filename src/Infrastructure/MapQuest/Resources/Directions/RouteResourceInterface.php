<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\MapQuest\Resources\Directions;

interface RouteResourceInterface
{
    public function request(array $locations): string;
}
