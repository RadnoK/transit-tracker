<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Ramsey\Uuid\Doctrine\UuidBinaryType;
use Ramsey\Uuid\Uuid;
use TransitTracker\Domain\Model\Id;

final class IdBinaryType extends UuidBinaryType
{
    public function convertToPHPValue($value, AbstractPlatform $platform): Id
    {
        return Id::fromUuidInstance(parent::convertToPHPValue($value, $platform));
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof Id) {
            $value = Uuid::fromString($value->value());
        }

        return parent::convertToDatabaseValue($value, $platform);
    }
}
