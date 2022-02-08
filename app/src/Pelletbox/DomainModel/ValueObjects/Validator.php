<?php

namespace App\src\Pelletbox\DomainModel\ValueObjects;

use App\src\Pelletbox\Exceptions\InvalidDataStructure;

interface Validator
{
    /**
     * @throws InvalidDataStructure
     */
    public static function validate(array $dataStructure): void;
}
