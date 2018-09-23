<?php

declare(strict_types=1);

namespace TransitTracker\Application\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadTrait;
use TransitTracker\Domain\Model\Id;
use TransitTracker\Domain\Model\Location;

final class AddLocationToRoute extends Command
{
    use PayloadTrait;

    private function __construct(array $payload)
    {
        $this->init();
        $this->setPayload($payload);
    }

    public static function create(Id $routeId, Location $location): self
    {
        return new self([
            'routeId' => $routeId->value(),
            'location' => [
                'address' => $location->address(),
            ],
        ]);
    }

    public function routeId()
    {
        return Id::fromString($this->payload()['routeId']);
    }

    public function location(): Location
    {
        return new Location($this->payload()['location']['address']);
    }
}
