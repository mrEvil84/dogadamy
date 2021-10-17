<?php

declare(strict_types=1);

namespace App\src\Categories\Application;

use App\Events\CreateCategoryProcessed;
use App\src\Categories\Application\Command\AddCategory;
use App\src\Categories\DomainModel\CategoriesRepository;

class CategoriesService
{
    private CategoriesRepository $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function addCategory(AddCategory $command): void
    {
        if ($this->categoriesRepository->assertCategoryExists($command->getCategoryName())) {
            // tu mozna dac bardziej rozszerzona obsluge wyjatkow
            throw new \Exception('Category already exists');
        }

        if (!$this->categoriesRepository->assertLocaleExists($command->getLocaleName())) {
            throw new \Exception('Locale name don\'t exists');
        }

        $localeId = $this->categoriesRepository->getLocaleId($command->getLocaleName());

        $result = $this->categoriesRepository->addCategory($command->getCategoryName(), $localeId);

        if (!$result) {
            throw new \Exception('Add category failed.');
        }

        event(new CreateCategoryProcessed($command->getCategoryName()));
    }

    public function deleteCategory(string $categoryName): void
    {
        if (!$this->categoriesRepository->assertCategoryExists($categoryName)) {
            throw new \Exception('Category already deleted.');
        }

        $this->categoriesRepository->deleteCategory($categoryName);
    }
}
