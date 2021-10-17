<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'category_name' => 'ludzie',
                    'category_locale_id' => LocaleSeeder::PL_LOCALE_ID,
                ],
                [
                    'category_name' => 'people',
                    'category_locale_id' => LocaleSeeder::EN_LOCALE_ID,
                ],
                [
                    'category_name' => 'Leute',
                    'category_locale_id' => LocaleSeeder::DE_LOCALE_ID,
                ],
                [
                    'category_name' => 'personnes',
                    'category_locale_id' => LocaleSeeder::FR_LOCALE_ID,
                ],
                [
                    'category_name' => 'pojazdy',
                    'category_locale_id' => LocaleSeeder::PL_LOCALE_ID,
                ],
                [
                    'category_name' => 'vehicles',
                    'category_locale_id' => LocaleSeeder::EN_LOCALE_ID,
                ],
                [
                    'category_name' => 'Fahrzeuge',
                    'category_locale_id' => LocaleSeeder::DE_LOCALE_ID,
                ],
                [
                    'category_name' => 'Véhicules',
                    'category_locale_id' => LocaleSeeder::FR_LOCALE_ID,
                ],
                [
                    'category_name' => 'ksiazki',
                    'category_locale_id' => LocaleSeeder::PL_LOCALE_ID,
                ],
                [
                    'category_name' => 'books',
                    'category_locale_id' => LocaleSeeder::EN_LOCALE_ID,
                ],
                [
                    'category_name' => 'Bücher',
                    'category_locale_id' => LocaleSeeder::DE_LOCALE_ID,
                ],
                [
                    'category_name' => 'livres',
                    'category_locale_id' => LocaleSeeder::FR_LOCALE_ID,
                ],
            ]
        );
    }
}
