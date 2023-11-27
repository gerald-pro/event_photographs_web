<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfilePhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('profile_photos')->insert([
            [
                'photo_path' => 'users/nrlg22mvrmbewixsltez',
                'user_id' => '1',
                'face_id' => 'c9a29d01-18f9-41e5-9e55-54dddd22bd5f',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'photo_path' => 'users/gc7ybnamdb21mtimp1ph',
                'user_id' => '2',
                'face_id' => 'c2b88248-7ccd-49ee-905f-910169e4b6ac',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'photo_path' => 'users/mjfxryyrvdn4x0hx7oeu',
                'user_id' => '3',
                'face_id' => '1401bb55-e65d-400b-b212-1f6635217189',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'photo_path' => 'users/pu3pk2dlfoyijjxvoqy8',
                'user_id' => '4',
                'face_id' => '97c3c33c-3b07-4b33-a44e-f34ea1677e26',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'photo_path' => 'users/uvz5dhikkniohwlqwhwn',
                'user_id' => '5',
                'face_id' => 'd804a9b5-3799-4a34-8474-853f8f724a10',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'photo_path' => 'users/ked8fvv24e0hwjpytbv4',
                'user_id' => '6',
                'face_id' => 'a8be0b04-1f78-43b0-b177-2ee56d8263a9',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]


        ]);
    }
}
