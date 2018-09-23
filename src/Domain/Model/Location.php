<?php

declare(strict_types=1);

namespace TransitTracker\Domain\Model;

use TransitTracker\Domain\Exception\InvalidLocationAddressException;

final class Location
{
    /** @var string */
    private $address;

    public function __construct(string $address)
    {
        if (false === strpos($address, ',')) {
            throw new InvalidLocationAddressException();
        }

        $this->address = $address;
    }

    public function address(): string
    {
        return $this->address;
    }
}
