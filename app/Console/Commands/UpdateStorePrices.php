<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use App\Models\Store;
use App\Models\StorePrice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateStorePrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store-prices:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update average, high, and low prices for stores per item';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Tokyo');
        $this->info('Store Item Prices Update Start.');
        $this->info(date('Y年m月d日H時i分s秒'));

        $stores = Store::all();
        $items = Item::all();

        foreach ($items as $item) {
            foreach ($stores as $store){
                $this->info('['.$item->name.' - '.$store->name.'] Start');

                $summaryData = DB::table('posts')
                    ->where('store_id', $store->id)
                    ->where('item_id', $item->id)
                    ->select(
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('AVG(price) as average_price'),
                        DB::raw('MAX(price) as highest_price'),
                        DB::raw('MIN(price) as lowest_price')
                    )
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->get();

                foreach ($summaryData as $data) {
                    $date = $data->date;
                    $averagePrice = (int) round($data->average_price);
                    $highestPrice = (int) $data->highest_price;
                    $lowestPrice = (int) $data->lowest_price;

                    StorePrice::updateOrCreate(
                        [
                            'date' => $date,
                            'item_id' => $item->id,
                            'store_id' => $store->id,
                        ],
                        [
                            'average_price' => $averagePrice,
                            'low_price' => $lowestPrice,
                            'high_price' => $highestPrice,
                        ]
                    );
                    $this->info('>'.$data->date . ' finish');
                }
            }
        }

        $this->info('Store Item Prices data updated successfully');
    }
}
