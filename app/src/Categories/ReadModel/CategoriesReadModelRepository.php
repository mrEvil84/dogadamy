<?php

namespace App\src\Categories\ReadModel;

interface CategoriesReadModelRepository
{
    public function getCategories(string $locale): array;
}
