<?php

declare(strict_types=1);

namespace App\src\Categories\Infrastructure;

use App\src\Categories\ReadModel\CategoriesReadModelRepository;
use Illuminate\Database\ConnectionInterface;

class CategoriesReadModelDbRepository implements CategoriesReadModelRepository
{
    private ConnectionInterface $db;

    public function __construct(ConnectionInterface $db) {
        $this->db = $db;
    }

    public function getCategories(string $locale): array
    {
        $sql = '
            select
                c.category_name
            from
                categories as c
            join
                locale as l
            on
                l.id = c.category_locale_id
            where
                  l.locale_name = :locale';

        return $this->db->select(
            $sql,
            [
                'locale' => $locale
            ]
        );
    }
}
