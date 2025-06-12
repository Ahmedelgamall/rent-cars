<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $row=config('permission.models.role')::create(['name' => 'super admin']);
        $row->permissions()->sync(\Spatie\Permission\Models\Permission::pluck('id')->toArray());
        \App\Models\User::first()->roles()->sync([$row->id]);
    }
}
