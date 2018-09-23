<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\ReadModel\View;

class LocationView
{
    /** @var int */
    private $id;

    /** @var RouteView */
    private $route;

    /** @var string */
    private $address;

    public function __construct(RouteView $route, string $address)
    {
        $this->route = $route;
        $this->address = $address;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRoute(): RouteView
    {
        return $this->route;
    }

    public function setRoute(RouteView $route): void
    {
        $this->route = $route;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
}
