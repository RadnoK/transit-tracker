<?php

declare(strict_types=1);

namespace TransitTracker\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Route
{
    /** @var Id */
    private $id;

    /** @var string */
    private $name;

    /** @var Distance */
    private $distance;

    /** @var Collection */
    private $locations;

    private function __construct(Id $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->distance = new Distance(0);
        $this->locations = new ArrayCollection();
    }

    public static function create(Id $id, string $name): self
    {
        return new self($id, $name);
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function addLocation(Location $location): void
    {
        $this->locations->add($location);
    }

    public function changeDistance(Distance $distance): void
    {
        $this->distance = $distance;
    }
}
