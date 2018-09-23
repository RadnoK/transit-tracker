<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\Doctrine\Type;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use TransitTracker\Domain\Model\Location;

final class LocationsType extends Type
{
    private const NAME = 'locations';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof Collection) {
            return json_encode($value);
        }

        throw ConversionException::conversionFailed($value, static::NAME);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Collection
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof Collection) {
            return $value;
        }

        try {
            $locations = new ArrayCollection();

            $rawLocations = json_decode($value, true);

            foreach ($rawLocations['products'] as $rawLocation) {
                $locations->add(new Location($rawLocation['address']));
            }

            return $locations;
        } catch (\InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, static::NAME);
        }
    }

    public function getName(): string
    {
        return static::NAME;
    }
}
