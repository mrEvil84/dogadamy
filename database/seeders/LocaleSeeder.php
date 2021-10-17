<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocaleSeeder extends Seeder
{
    public const PL_LOCALE_ID = 1;
    public const EN_LOCALE_ID = 2;
    public const DE_LOCALE_ID = 3;
    public const FR_LOCALE_ID = 4;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locale')->insert(
            [
                [
                    'id' => self::PL_LOCALE_ID,
                    'locale_name' => 'PL',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'id' => self::EN_LOCALE_ID,
                    'locale_name' => 'EN',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'id' => self::DE_LOCALE_ID,
                    'locale_name' => 'DE',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'id' => self::FR_LOCALE_ID,
                    'locale_name' => 'FR',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
