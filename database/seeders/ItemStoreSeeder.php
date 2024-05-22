<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('item_store')->insert([
            'item_id' => 1,
            'store_id' => 1,
            'created_at' => '2024-05-22 18:00:00',
            'updated_at' => '2024-05-22 18:00:00'
        ]);

        DB::table('item_store')->insert([
            'item_id' => 1,
            'store_id' => 2,
            'created_at' => '2024-05-22 18:00:00',
            'updated_at' => '2024-05-22 18:00:00'
        ]);

        DB::table('item_store')->insert([
            'item_id' => 1,
            'store_id' => 3,
            'created_at' => '2024-05-22 18:00:00',
            'updated_at' => '2024-05-22 18:00:00'
        ]);

        DB::table('item_store')->insert([
            'item_id' => 1,
            'store_id' => 4,
            'created_at' => '2024-05-22 18:00:00',
            'updated_at' => '2024-05-22 18:00:00'
        ]);

        DB::table('item_store')->insert([
            'item_id' => 1,
            'store_id' => 5,
            'created_at' => '2024-05-22 18:00:00',
            'updated_at' => '2024-05-22 18:00:00'
        ]);
    }
}
