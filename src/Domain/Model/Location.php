<?php

declare(strict_types=1);

namespace TransitTracker\Domain\Model;

final class Location
{
    /** @var string */
    private $address;

    public function __construct(string $address)
    {
        $this->address = $address;
    }

    public function address(): string
    {
        return $this->address;
    }
}
