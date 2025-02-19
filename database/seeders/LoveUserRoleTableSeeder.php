<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoveUserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_role')->insert([
            'user_id' => 1,
            'role_id' => 1,
            'created_at' => '2025-02-19 17:51:58',
            'updated_at' => '2025-02-19 17:51:58',
        ]);
    }
}
