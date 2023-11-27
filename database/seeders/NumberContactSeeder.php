<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NumberContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('number_contacts')->insert([
            [
                'number' => '7000000',
                'user_id' => '1',
            ],
            [
                'number' => '7000000',
                'user_id' => '2',
            ],
            [
                'number' => '7000000',
                'user_id' => '3',
            ],
            [
                'number' => '7000000',
                'user_id' => '4',
            ],
            [
                'number' => '7000000',
                'user_id' => '5',
            ],
            [
                'number' => '7000000',
                'user_id' => '6',
            ]
        ]);

    }
}
