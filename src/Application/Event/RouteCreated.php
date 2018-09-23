<?php

declare(strict_types=1);

namespace TransitTracker\Application\Event;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Common\Messaging\PayloadTrait;
use TransitTracker\Domain\Model\Id;

final class RouteCreated extends DomainEvent
{
    use PayloadTrait;

    private function __construct(array $payload)
    {
        $this->init();
        $this->setPayload($payload);
    }

    public static function occur(Id $id): self
    {
        return new self(['id' => $id->value()]);
    }

    public function id(): Id
    {
        return Id::fromString($this->payload()['id']);
    }
}
