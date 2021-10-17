<?php

declare(strict_types=1);

namespace App\src\Categories\ReadModel;

use App\src\Categories\ReadModel\Query\GetCategories;

class CategoriesReadModel
{
    private CategoriesReadModelRepository $categoriesReadModelRepository;

    public function __construct(CategoriesReadModelRepository $categoriesReadModelRepository)
    {
        $this->categoriesReadModelRepository = $categoriesReadModelRepository;
    }

    public function getCategories(GetCategories $query): array
    {
        return $this->categoriesReadModelRepository->getCategories($query->getLocale());
    }
}
