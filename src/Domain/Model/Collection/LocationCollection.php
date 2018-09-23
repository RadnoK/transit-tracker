<?php

declare(strict_types=1);

namespace TransitTracker\Domain\Model\Collection;

use TransitTracker\Domain\Exception\LocationAlreadyExistsException;
use TransitTracker\Domain\Model\Location;

final class LocationCollection
{
    /** @var array */
    private $locations = [];

    private function __construct(array $locations = [])
    {
        $this->locations = $locations;
    }

    public static function createEmpty(): self
    {
        return new self();
    }

    public function count(): int
    {
        return count($this->locations);
    }

    public function get($argument1)
    {
        // TODO: write logic here
    }

    public function add(Location $location)
    {
        $address = $location->address();

        if (in_array($address, $this->locations)) {
            throw new LocationAlreadyExistsException();
        }

        $this->locations[] = $address;
    }

    public function toArray(): array
    {
        $locations = [];

        /** @var Location $location */
        foreach ($this->locations as $location) {
            $locations[] = [$location->address()];
        }

        return $locations;
    }
}
