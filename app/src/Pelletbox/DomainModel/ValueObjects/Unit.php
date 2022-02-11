<?php

namespace App\src\Pelletbox\DomainModel\ValueObjects;

use App\src\Pelletbox\Exceptions\InvalidDataStructure;
use App\src\Pelletbox\Exceptions\InvalidValueException;

final class Unit implements Validator, Initializer
{
    use StructureValidator;

    public const DEFAULT_UNIT_WEIGHT = 15;
    public const DEFAULT_UNIT_COUNT = 1;

    private const UNIT_COUNT = 'unitCount';
    private const UNIT_WEIGHT = 'unitWeight';
    private const PRODUCER = 'producer';
    private const REQUIRED_STRUCTURE_KEYS = [self::UNIT_COUNT, self::UNIT_WEIGHT, self::PRODUCER];

    private Producer $producer;
    private int $unitCount;
    private int $unitWeight;

    public function __construct(
        Producer $producer,
        int $unitCount = self::DEFAULT_UNIT_COUNT,
        int $unitWeight = self::DEFAULT_UNIT_WEIGHT
    ) {
        if ($unitCount <= 0) {
            throw new InvalidValueException('Invalid unit count.');
        }

        if ($unitWeight <= 0) {
            throw new InvalidValueException('Invalid unit weight.');
        }

        $this->producer = $producer;
        $this->unitCount = $unitCount;
        $this->unitWeight = $unitWeight;
    }

    public function getUnitCount(): int
    {
        return $this->unitCount;
    }

    public function getUnitWeight(): int
    {
        return $this->unitWeight;
    }

    public function getProducer(): Producer
    {
        return $this->producer;
    }

    public function toArray(): array
    {
        return [
            'unitCount' => $this->unitCount,
            'unitWeight' => $this->unitWeight,
            'producer' => $this->producer->toArray(),
        ];
    }

    /**
     * @throws \JsonException
     */
    public function __toString(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    /**
     * @throws InvalidDataStructure
     */
    public static function validate(array $dataStructure): void
    {
        if (!self::isValid($dataStructure, self::REQUIRED_STRUCTURE_KEYS)) {
            throw new InvalidDataStructure('Invalid data structure for Unit ');
        }
    }

    /**
     * @throws InvalidDataStructure
     * @throws InvalidValueException
     */
    public static function fromRawData(array $rawData): self
    {
        self::validate($rawData);

        return new self(
            Producer::fromRawData($rawData[self::PRODUCER]),
            (int)$rawData[self::UNIT_COUNT],
            (int)$rawData[self::UNIT_WEIGHT]
        );
    }
}
