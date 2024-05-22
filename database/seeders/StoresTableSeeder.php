<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stores')->insert([
            'name' => 'KOHYO堀江店',
            'description' => 'イオン系列のスーパー。広くはないが、品揃えが充実している。',
            'opening_time' => '09:00',
            'closing_time' => '23:30',
            'postal_code' => '5500014',
            'address' => '大阪府大阪市西区北堀江4-4-1',
            'phone_number' => '0665434307',
            'homepage' => 'https://www.kohyo.co.jp/',
            'created_at' => '2024-05-22 13:00:00',
            'updated_at' => '2024-05-22 13:00:00',
        ]);

        DB::table('stores')->insert([
            'name' => '関西スーパー南堀江店',
            'description' => '月曜日と火曜日は10パーセント引きセールを開催。',
            'opening_time' => '09:00',
            'closing_time' => '22:00',
            'postal_code' => '5500015',
            'address' => '大阪府大阪市西区南堀江4-5-22',
            'phone_number' => '0665431241',
            'homepage' => 'http://www.kansaisuper.co.jp/',
            'created_at' => '2024-05-22 13:00:00',
            'updated_at' => '2024-05-22 13:00:00',
        ]);

        DB::table('stores')->insert([
            'name' => 'ライフ西大橋店',
            'description' => '1階が食品売り場で、2階はお菓子・酒類・日用品などを扱っている。',
            'opening_time' => '09:30',
            'closing_time' => '24:00',
            'postal_code' => '5500013',
            'address' => '大阪府大阪市西区新町2-9-17',
            'phone_number' => '0665310891',
            'homepage' => 'http://www.lifecorp.jp/',
            'created_at' => '2024-05-22 13:00:00',
            'updated_at' => '2024-05-22 13:00:00',
        ]);

        DB::table('stores')->insert([
            'name' => 'ビッグビーンズWest本店',
            'description' => 'オーガニック食材や珍しい調味料などが揃う、高級スーパー',
            'opening_time' => '10:00',
            'closing_time' => '21:00',
            'postal_code' => '5500013',
            'address' => '大阪府大阪市西区新町1-30-7',
            'phone_number' => '0665347616',
            'homepage' => 'http://www.big-beans.com/',
            'created_at' => '2024-05-22 13:00:00',
            'updated_at' => '2024-05-22 13:00:00',
        ]);

        DB::table('stores')->insert([
            'name' => '阪急オアシス新町店',
            'description' => 'ワインの品揃えが充実。イートインスペースがある。',
            'opening_time' => '09:30',
            'closing_time' => '22:00',
            'postal_code' => '5500013',
            'address' => '大阪府大阪市西区新町4-6-23',
            'phone_number' => '0643913460',
            'homepage' => 'https://hankyu-oasis.h2o-foods.co.jp/',
            'created_at' => '2024-05-22 13:00:00',
            'updated_at' => '2024-05-22 13:00:00',
        ]);
    }
}
