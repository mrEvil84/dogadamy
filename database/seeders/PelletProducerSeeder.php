<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelletProducerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pellet_producer')->insert(
            [
                [
                    'producer_name' => 'Poltarex',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
