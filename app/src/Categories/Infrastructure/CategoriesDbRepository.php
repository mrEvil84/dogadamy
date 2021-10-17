<?php

declare(strict_types=1);


namespace App\src\Categories\Infrastructure;

use App\src\Categories\DomainModel\CategoriesRepository;
use Illuminate\Database\ConnectionInterface;

class CategoriesDbRepository implements CategoriesRepository
{
    private ConnectionInterface $db;

    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }

    public function addCategory(string $categoryName, int $localeId): bool
    {
       $sql = 'insert into categories (category_name, category_locale_id) values(:categoryName, :categoryLocaleId)';
       return $this->db->insert(
           $sql,
           [
               'categoryName' => $categoryName,
               'categoryLocaleId' => $localeId
           ]
       );
    }

    public function assertCategoryExists(string $categoryName): bool
    {
        $sql = 'select 1 from categories as c where c.category_name = :categoryName';
        $category = $this->db->selectOne($sql, ['categoryName' => $categoryName]);

        return !empty($category);
    }

    public function assertLocaleExists(string $localeName): bool
    {
        $sql = 'select 1 from locale as l where l.locale_name = :localeName';
        $localeResult = $this->db->selectOne($sql, ['localeName' => $localeName]);

        return !empty($localeResult);
    }

    public function getLocaleId(string $localeName): int
    {
       $sql = 'select l.id from locale as l where l.locale_name = :localeName';
       $locale = $this->db->selectOne($sql, ['localeName' => $localeName]);

       return (int)$locale->id;
    }

    public function deleteCategory(string $categoryName): bool
    {
        $sql = 'delete from categories where category_name = :categoryName';
        $deletedCategoryResult = $this->db->delete($sql, ['categoryName' => $categoryName]);

        return $deletedCategoryResult === 1;
    }
}
