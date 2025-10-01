<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('acs')->insert([
            [
                'nama' => 'AC Split 1',
                'ruangan' => 'Ruang Server',
                'nomor' => 'AC001',
                'merk' => 'Daikin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'AC Split 2',
                'ruangan' => 'Ruang Rapat',
                'nomor' => 'AC002',
                'merk' => 'Panasonic',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'AC Cassette',
                'ruangan' => 'Lobby Utama',
                'nomor' => 'AC003',
                'merk' => 'LG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
