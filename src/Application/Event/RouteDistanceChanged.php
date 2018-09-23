<?php

declare(strict_types=1);

namespace TransitTracker\Application\Event;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Common\Messaging\PayloadTrait;
use TransitTracker\Domain\Model\Distance;
use TransitTracker\Domain\Model\Id;

final class RouteDistanceChanged extends DomainEvent
{
    use PayloadTrait;

    private function __construct(array $payload)
    {
        $this->init();
        $this->setPayload($payload);
    }

    public static function occur(Id $id, Distance $distance): self
    {
        return new self([
            'id' => $id->value(),
            'distance' => $distance->kilometers(),
        ]);
    }

    public function id(): Id
    {
        return Id::fromString($this->payload()['id']);
    }

    public function distance(): Distance
    {
        return new Distance($this->payload()['distance']);
    }
}
