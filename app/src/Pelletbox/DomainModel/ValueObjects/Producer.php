<?php

namespace App\src\Pelletbox\DomainModel\ValueObjects;

use App\src\Pelletbox\Exceptions\InvalidDataStructure;
use App\src\Pelletbox\Exceptions\InvalidValueException;

final class Producer implements Validator
{
    use StructureValidator;

    private int $id;
    private string $name;

    private const REQUIRED_STRUCTURE_KEYS = ['id', 'name'];

    /**
     * @throws InvalidValueException
     */
    public function __construct(int $id, string $name)
    {
        if ($id <= 0) {
            throw new InvalidValueException('Invalid producer id.');
        }
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    /**
     * @throws InvalidDataStructure
     */
    public static function validate(array $dataStructure): void
    {
        if (!self::isValid($dataStructure, self::REQUIRED_STRUCTURE_KEYS)) {
            throw new InvalidDataStructure('Invalid data structure for Producer ');
        }
    }
}
