<?php

namespace App\src\Pelletbox\SharedKernel;

class DateKey implements Key
{
    private \DateTime $key;

    public function __construct(\DateTime $key)
    {
        $this->key = $key;
    }

    public function getKeyValue(): string
    {
        return $this->key->format('Y-m-d');
    }
}
