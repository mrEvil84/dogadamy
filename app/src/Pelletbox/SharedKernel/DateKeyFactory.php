<?php

namespace App\src\Pelletbox\SharedKernel;

class DateKeyFactory implements KeyFactory
{
    public function create(): DateKey
    {
        return new DateKey(\DateTime::createFromFormat('Y-m-d', now()));
    }
}
