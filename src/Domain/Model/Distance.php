<?php

declare(strict_types=1);

namespace TransitTracker\Domain\Model;

use TransitTracker\Domain\Exception\InvalidDistanceValueException;

final class Distance
{
    /** @var float */
    private $kilometers;

    public function __construct(float $kilometers)
    {
        if (0 > $kilometers) {
            throw new InvalidDistanceValueException();
        }

        $this->kilometers = $kilometers;
    }

    public function kilometers(): float
    {
        return $this->kilometers;
    }
}
