<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoveRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'superAdmin',
            'permission_ids' => '1',
            'created_at' => '2025-02-19 17:50:34',
            'updated_at' => '2025-02-19 17:50:34',
        ]);
    }
}
