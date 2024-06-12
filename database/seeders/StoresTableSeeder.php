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

        DB::table('stores')->insert([
            'name' => 'スーパー玉出堀江店',
            'description' => '24時間営業の激安スーパー。',
            'opening_time' => '00:00',
            'closing_time' => '00:00',
            'postal_code' => '550-0015',
            'address' => '大阪府大阪市西区南堀江2-9-28',
            'phone_number' => '0665345700',
            'homepage' => 'http://www.supertamade.co.jp/sales/handbill/',
            'latitude' => '34.67101444',
            'longitude' => '135.49137988',
            'created_at' => '2024-06-06 16:00:00',
            'updated_at' => '2024-06-06 16:00:00',
        ]);

        DB::table('stores')->insert([
            'name' => 'スーパーオオカワ桜川店',
            'description' => '必要最低限のものは揃う。',
            'opening_time' => '08:30',
            'closing_time' => '22:30',
            'postal_code' => '556-0022',
            'address' => '大阪府大阪市浪速区桜川2-6-26',
            'phone_number' => '0665677272',
            'homepage' => 'http://www.kk-okawa.co.jp/shop/',
            'latitude' => '34.66730871',
            'longitude' => '135.49127733',
            'created_at' => '2024-06-06 16:00:00',
            'updated_at' => '2024-06-06 16:00:00',
        ]);

        DB::table('stores')->insert([
            'name' => '食品館アプロ桜川店',
            'description' => '100円ショップWattsが併設されている。',
            'opening_time' => '09:30',
            'closing_time' => '22:00',
            'postal_code' => '556-0022',
            'address' => '大阪府大阪市浪速区桜川3-1-20',
            'phone_number' => '0665611005',
            'homepage' => 'https://www.kk-kano.co.jp/store/osaka_city/sakuragawa/',
            'latitude' => '34.66783709',
            'longitude' => '135.48783924',
            'created_at' => '2024-06-06 16:00:00',
            'updated_at' => '2024-06-06 16:00:00',
        ]);

        DB::table('stores')->insert([
            'name' => 'イオンフードスタイル四ツ橋店',
            'description' => '大阪メトロ四ツ橋駅から徒歩1分。',
            'opening_time' => '00:00',
            'closing_time' => '00:00',
            'postal_code' => '550-0013',
            'address' => '大阪府大阪市西区新町1-5-8',
            'phone_number' => '0665780101',
            'homepage' => 'https://www.daiei.co.jp/stores/d0878/',
            'latitude' => '34.67560949',
            'longitude' => '135.49637823',
            'created_at' => '2024-06-06 16:00:00',
            'updated_at' => '2024-06-06 16:00:00',
        ]);

        DB::table('stores')->insert([
            'name' => 'イオン大阪ドームシティ店',
            'description' => '売り場が広く、品揃え豊富。',
            'opening_time' => '08:00',
            'closing_time' => '23:00',
            'postal_code' => '550-0023',
            'address' => '大阪府大阪市西区千代崎3-13-1',
            'phone_number' => '0665841500',
            'homepage' => 'https://www.aeon.com/',
            'latitude' => '34.67043958',
            'longitude' => '135.47812044',
            'created_at' => '2024-06-06 16:00:00',
            'updated_at' => '2024-06-06 16:00:00',
        ]);

        DB::table('stores')->insert([
            'name' => 'セントラルスクエアなんば店',
            'description' => 'JR難波駅直結。',
            'opening_time' => '09:00',
            'closing_time' => '00:00',
            'postal_code' => '556-0017',
            'address' => '大阪府大阪市浪速区湊町1-2-3',
            'phone_number' => '0666340300',
            'homepage' => 'http://www.lifecorp.jp/',
            'latitude' => '34.66669879',
            'longitude' => '135.49623776',
            'created_at' => '2024-06-06 16:00:00',
            'updated_at' => '2024-06-06 16:00:00',
        ]);
    }
}
