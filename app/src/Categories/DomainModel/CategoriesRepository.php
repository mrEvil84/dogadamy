<?php

namespace App\src\Categories\DomainModel;

interface CategoriesRepository
{
    public function addCategory(string $categoryName, int $localeId): bool;

    public function assertCategoryExists(string $categoryName): bool;

    public function assertLocaleExists(string $localeName): bool;

    public function getLocaleId(string $localeName): int;

    public function deleteCategory(string $categoryName): bool;

}
