<?php

declare(strict_types=1);

namespace App\src\Categories\Application\Command;

class AddCategory
{
    private string $categoryName;
    private string $localeName;

    public function __construct(string $categoryName, string $localeName)
    {
        $this->categoryName = $categoryName;
        $this->localeName = $localeName;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function getLocaleName(): string
    {
        return $this->localeName;
    }

}
