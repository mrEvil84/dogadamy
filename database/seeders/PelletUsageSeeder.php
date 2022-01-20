<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelletUsageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pellet_usage')->insert(
            [
                [
                    'bag_amount' => 1,
                    'producer_id' => 1,
                    'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-20 08:20:20')->format('Y-m-d H:i:s'),
                ],
                [
                    'bag_amount' => 1,
                    'producer_id' => 1,
                    'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-20 18:20:20')->format('Y-m-d H:i:s'),
                ],
                [
                    'bag_amount' => 2,
                    'producer_id' => 1,
                    'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-21 18:20:20')->format('Y-m-d H:i:s'),
                ],
                [
                    'bag_amount' => 2,
                    'producer_id' => 1,
                    'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-22 18:20:20')->format('Y-m-d H:i:s'),
                ],
                [
                    'bag_amount' => 2,
                    'producer_id' => 1,
                    'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-23 18:20:20')->format('Y-m-d H:i:s'),
                ],
                [
                    'bag_amount' => 2,
                    'producer_id' => 1,
                    'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-24 18:20:20')->format('Y-m-d H:i:s'),
                ],
                [
                    'bag_amount' => 2,
                    'producer_id' => 1,
                    'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-25 18:20:20')->format('Y-m-d H:i:s'),
                ],
                [
                    'bag_amount' => 2,
                    'producer_id' => 1,
                    'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-26 18:20:20')->format('Y-m-d H:i:s'),
                ],
                [
                    'bag_amount' => 2,
                    'producer_id' => 1,
                    'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-27 18:20:20')->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
