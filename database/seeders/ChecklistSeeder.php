<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Checklist;

class ChecklistSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Hidupkan Chiller, AHU & Pengecekan lampu PJU mati', '07:00', '07:15'],
            ['Hidupkan AC kantin', '11:00', '11:10'],
            ['Hidupkan AC Musholla', '11:30', '11:40'],
            ['Mematikan AC kantin dan Musholla', '13:00', '13:15'],
            ['Hidupkan AC Musholla', '14:40', '14:50'],
            ['Mematikan AC Musholla', '15:40', '15:50'],
            ['Mematikan Chiller', '16:45', '17:00'],
            ['Mematikan seluruh AHU & Pengecekan lampu PJU dipastikan on', '17:30', '17:45'],
            ['Kontrol malam (pengecekan lampu, peralatan yang tidak terpakai di toilet dan pantry)', '18:00', '19:00'],
        ];

        foreach ($data as $item) {
            Checklist::create([
                'aktivitas' => $item[0],
                'jam_mulai' => $item[1],
                'jam_selesai' => $item[2],
            ]);
        }
    }
}
