<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Checklist;

class ChecklistSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Hidupkan Chiller dan AHU & Pengecekan lampu PJU dipastikan off', '07:00', '07:15'],
            ['Pencatatan meteran listrik, air, dan STP', '07:15', '07:30'],
            ['Pencatatan pemakaian listrik tenant lantai 6, 7, 8, VRV, dan Chiller', '07:30', '07:45'],
            ['Logsheet Pump Room', '07:45', '08:00'],
            ['TBM Pagi', '08:30', '08:45'],
            ['Logsheet genset', '08:50', '09:00'],
            ['Logsheet STP', '09:00', '09:30'],
            ['Pengecekan sanitari toilet', '09:30', '10:00'],
            ['Pengecekan suhu ruangan', '10:00', '10:20'],
            ['Hidupkan AC kantin', '11:00', '11:10'],
            ['Hidupkan AC Musholla', '11:30', '11:40'],
            ['Pengecekan Suhu Ruangan', '12:00', '12:20'],
            ['Mematikan AC kantin dan Musholla', '13:00', '13:15'],
            ['Pengecekan Suhu Ruangan', '14:00', '14:20'],
            ['Hidupkan AC Musholla', '14:40', '14:50'],
            ['Mematikan AC Musholla', '15:40', '15:50'],
            ['Pencatatan meteran listrik, air, dan STP', '16:00', '16:15'],
            ['Pengecekan Suhu Ruangan', '16:15', '16:30'],
            ['Logsheet Pump Room', '16:30', '16:45'],
            ['Mematikan Chiller', '16:45', '17:00'],
            ['Pencatatan beban pemakaian listrik tenant lantai 6, 7, 8, VRV, dan Chiller', '17:00', '17:15'],
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
