<?php

declare(strict_types=1);

namespace TransitTracker\Domain\Model;

use Ramsey\Uuid\UuidInterface;
use TransitTracker\Domain\Model\Collection\LocationCollection;

final class Route
{
    /** @var UuidInterface */
    private $id;

    /** @var LocationCollection */
    private $locations;

    private function __construct(UuidInterface $id)
    {
        $this->id = $id;
        $this->locations = LocationCollection::createEmpty();
    }

    public static function create(UuidInterface $id): self
    {
        return new self($id);
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }
}
