<?php

namespace App\src\Pelletbox\SharedKernel;

interface KeyFactory
{
    public function create(): Key;
}
