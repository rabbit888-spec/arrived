<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoveSqlLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sql_log')->insert([
            'id' => 1,
            'user_id' => '1',
            'sql' => 'select * from `love_sql_log`',
            'error' => '',
            'created_at' => '2025-02-19 17:50:34',
        ]);
    }
}
