<?php

declare(strict_types=1);

namespace TransitTracker\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Route
{
    /** @var Id */
    private $id;

    /** @var Collection */
    private $locations;

    private function __construct(Id $id)
    {
        $this->id = $id;
        $this->locations = new ArrayCollection();
    }

    public static function create(Id $id): self
    {
        return new self($id);
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function addLocation(Location $location): void
    {
        $this->locations->add($location);
    }
}
