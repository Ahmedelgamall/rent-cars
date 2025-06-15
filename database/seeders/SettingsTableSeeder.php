<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'id' => '1',
            'email' => 'admin@rent.com',
            'phone' => '01009706732',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
