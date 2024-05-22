<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            'name' => 'ブロッコリー',
            'created_at' => '2024-05-22 14:00:00',
            'updated_at' => '2024-05-22 14:00:00',
        ]);

        DB::table('items')->insert([
            'name' => '鶏ムネ肉',
            'created_at' => '2024-05-22 14:00:00',
            'updated_at' => '2024-05-22 14:00:00',
        ]);

        DB::table('items')->insert([
            'name' => 'たまご',
            'created_at' => '2024-05-22 14:00:00',
            'updated_at' => '2024-05-22 14:00:00',
        ]);

        DB::table('items')->insert([
            'name' => 'サバ缶',
            'created_at' => '2024-05-22 14:00:00',
            'updated_at' => '2024-05-22 14:00:00',
        ]);

        DB::table('items')->insert([
            'name' => 'トマト',
            'created_at' => '2024-05-22 14:00:00',
            'updated_at' => '2024-05-22 14:00:00',
        ]);

        DB::table('items')->insert([
            'name' => 'ティッシュ',
            'created_at' => '2024-05-22 14:00:00',
            'updated_at' => '2024-05-22 14:00:00',
        ]);
    }
}
