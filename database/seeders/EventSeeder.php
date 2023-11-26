<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $keyEvent1 = Str::uuid()->toString();
        $keyEvent2 = Str::uuid()->toString();

        DB::table('events')->insert([
            [
                'name' => 'Cumpleaños en el Urubó',
                'detail' => 'Fiesta de cumpleaños nro 25, con la hora loca y piscina',
                'address' => 'Santa Cruz, El Urubó, "Condominio la Hacienda" n24',
                'key_event' =>  $keyEvent1,
                'start_date' => now()->addMonth()->toDate(),
                'start_time' => now()->toTimeString(),
                'privacity' => '1',
                'user_id' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Graduacion de la carrera de derecho',
                'detail' => 'Fiesta de graduacion 2023 de la carrera de ing en sistemas',
                'address' => 'Santa Cruz, Av. Bush, Modulo 203',
                'key_event' => $keyEvent2,
                'start_date' => now()->addDays(20)->toDate(),
                'start_time' => now()->addHours(2)->toTimeString(),
                'privacity' => '2',
                'user_id' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);

        DB::table('event_photographers')->insert([
            'user_id' => 6,
            'event_id' => 1,
            'token' => JWT::encode(['user_id' => 6], $keyEvent1, 'HS256'),
            'status' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('event_photographers')->insert([
            'user_id' => 6,
            'event_id' => 2,
            'token' => JWT::encode(['user_id' => 6], $keyEvent2, 'HS256'),
            'status' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
