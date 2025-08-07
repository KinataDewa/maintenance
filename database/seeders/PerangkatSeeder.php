<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerangkatSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Chiller'],
            ['nama' => 'AHU'],
            ['nama' => 'AC Kantin'],
            ['nama' => 'AC Musholla'],
            ['nama' => 'Lampu PJU'],
        ];

        DB::table('perangkat')->insert($data);
    }
}
