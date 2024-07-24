<?php

namespace App\Console\Commands;
use App\Models\MonthlyPrice;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Console\Command;

class UpdateMonthlyPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly-prices:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Tokyo');
        $this->info('Price Summary Start.');
        $this->info(date('Y年m月d日 H時i分s秒'));

        $items = Item::all();
        foreach ($items as $item) {
            $this->info('['.$item->name . '] Start');

            $summaryData = DB::table('posts')
                ->where('item_id', $item->id)
                ->select(
                    DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                    DB::raw('AVG(price) as average_price'),
                    DB::raw('MAX(price) as highest_price'),
                    DB::raw('MIN(price) as lowest_price')
                )
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
                ->get();

        foreach ($summaryData as $data) {
            $month = $data->month . '-01';
            $averagePrice = (int) round($data->average_price);
            $highestPrice = (int) $data->highest_price;
            $lowestPrice = (int) $data->lowest_price;

            MonthlyPrice::updateOrCreate(
                ['month' => $month, 'item_id' => $item->id],
                [
                    'average_price' => $averagePrice,
                    'low_price' => $lowestPrice,
                    'high_price' => $highestPrice,
                ]
            );
            $this->info('>'.$data->month . ' finish');
        }

    }

    $this->info('['.$item->name . '] Monthly Prices data updated successfully');
    $this->info(date('Y年m月d日 H時i分s秒'));
    }
}
