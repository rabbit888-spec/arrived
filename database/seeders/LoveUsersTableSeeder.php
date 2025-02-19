<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoveUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'admin',
            'password' => '$2y$10$nlOtRngMYTA83XL44WGJ1OWPKIyXPF3tEV1ywMcavuj3Q0oGAuum2',
            'created_at' => '2025-02-19 17:50:34',
            'updated_at' => '2025-02-19 17:50:33',
        ]);
    }
}
