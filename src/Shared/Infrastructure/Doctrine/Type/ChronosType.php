<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Type;

use Cake\Chronos\Chronos;
use Cake\Chronos\ChronosInterface;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class ChronosType extends Type
{
    public function convertToPHPValue($value, AbstractPlatform $platform): ?ChronosInterface
    {
        if (null === $value) {
            return null;
        }

        return Chronos::createFromFormat(ChronosInterface::DEFAULT_TO_STRING_FORMAT, $value);
    }

    /**
     * @param ?ChronosInterface $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value?->format(ChronosInterface::DEFAULT_TO_STRING_FORMAT);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'datetime';
    }

    public function getName(): string
    {
        return 'chronos';
    }
}
