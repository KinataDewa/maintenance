<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerangkatSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Chiller 1'],
            ['nama' => 'Chiller 2'],
            ['nama' => 'Pompa Air 1'],
            ['nama' => 'Pompa Air 2'],
            ['nama' => 'AHU 1'],
            ['nama' => 'AHU 2'],
            ['nama' => 'AHU 3'],
            ['nama' => 'AHU 4'],
            ['nama' => 'AHU 5'],
            ['nama' => 'AHU 6'],
            ['nama' => 'AHU 7'],
            ['nama' => 'AHU 8'],
            ['nama' => 'AC Lift 1'],
            ['nama' => 'AC Lift 2'],
            ['nama' => 'AC Musholla'],
            ['nama' => 'Lampu Koridor 1'],
            ['nama' => 'Lampu Koridor 2'],
            ['nama' => 'Lampu Koridor 3'],
            ['nama' => 'Lampu Koridor 4'],
            ['nama' => 'Lampu Koridor 5'],
            ['nama' => 'Lampu Koridor 6'],
            ['nama' => 'Lampu Koridor 7'],
            ['nama' => 'Lampu Koridor 8'],
            ['nama' => 'Lampu Koridor 9'],
        ];

        DB::table('perangkat')->insert($data);
    }
}
