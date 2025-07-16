<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Andi', 'Budi', 'Citra', 'Dian', 'Eka'];
        foreach ($names as $name) {
            Staff::create(['name' => $name]);
        }
    }
}
