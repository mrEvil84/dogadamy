<?php

namespace App\src\Pelletbox\ReadModel\Query;

use App\src\Pelletbox\SharedKernel\Key;

class GetStatsByKey
{
    private Key $key;

    public function __construct(Key $key)
    {
        $this->key = $key;
    }

    public function getKey(): Key
    {
        return $this->key;
    }
}
