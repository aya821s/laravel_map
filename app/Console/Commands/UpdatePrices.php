<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Price;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdatePrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prices:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update average, high, and low prices for items';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        date_default_timezone_set('Asia/Tokyo');
        $this->info('Price Summary Start.');
        $this->info(date('Y年m月d日H時i分s秒'));

        $items = Item::all();
        foreach ($items as $item) {
            $this->info('['.$item->name . '] Start');
            $summaryData = DB::table('posts')
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

                Price::updateOrCreate(
                    ['date' => $date, 'item_id' => $item->id],
                    [
                        'average_price' => $averagePrice,
                        'low_price' => $lowestPrice,
                        'high_price' => $highestPrice,
                    ]
                );
                $this->info('>'.$data->date . ' finish');
            }
        }
        $this->info('Prices data updated successfully');
    }
}
