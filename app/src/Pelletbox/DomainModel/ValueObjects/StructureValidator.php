<?php

namespace App\src\Pelletbox\DomainModel\ValueObjects;

trait StructureValidator
{
    public static function isValid(array $dataStructure, array $expectedKeys): bool
    {
        $isValid = true;

        if (!empty(array_diff(array_keys($dataStructure), $expectedKeys))) {
            $isValid = false;
        }

        return $isValid;
    }
}
