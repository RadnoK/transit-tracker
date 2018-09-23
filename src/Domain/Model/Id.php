<?php

declare(strict_types=1);

namespace TransitTracker\Domain\Model;

use Ramsey\Uuid\Uuid;
use TransitTracker\Domain\Exception\InvalidUuidFormatException;

final class Id
{
    /** @var string */
    private $id;

    private function __construct(string $id)
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidUuidFormatException();
        }

        $this->id = $id;
    }

    public static function fromString(string $id): self
    {
        return new self($id);
    }

    public function __toString(): string
    {
        return $this->value();
    }

    public function value(): string
    {
        return $this->id;
    }
}
