<?php

declare(strict_types=1);

namespace App\src\Categories\ReadModel\Query;

class GetCategories
{
    private string $locale;

    public function __construct(string $locale)
    {
        $this->locale = $locale;
    }

    public function getLocale():string
    {
        return $this->locale;
    }
}
