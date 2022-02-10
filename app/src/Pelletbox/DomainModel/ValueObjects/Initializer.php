<?php

namespace App\src\Pelletbox\DomainModel\ValueObjects;

interface Initializer
{
    public static function fromRawData(array $rawData): self;
}
