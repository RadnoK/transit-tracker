<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\ReadModel\View;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class RouteView
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var float */
    private $distance = 0.0;

    /** @var \DateTime */
    private $createdAt;

    /** @var Collection|LocationView[] */
    private $locations;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = new \DateTime();
        $this->locations = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDistance(): float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): void
    {
        $this->distance = $distance;
    }

    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(LocationView $location): void
    {
        $this->locations->add($location);
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
