<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $tenants = [
            ['nama' => 'PT Sinar Jaya'],
            ['nama' => 'CV Mitra Abadi'],
            ['nama' => 'UD Bumi Langit'],
            ['nama' => 'PT Mega Elektrik'],
            ['nama' => 'PT Cahaya Nusantara'],
        ];

        foreach ($tenants as $tenant) {
            Tenant::create($tenant);
        }
    }
}
