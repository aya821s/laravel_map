<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Price;
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
        $summaryData = DB::table('posts')
            ->where('item_id', 1) // TODO item_id仮
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
                ['date' => $date, 'item_id' => 1],
                [
                    'average_price' => $averagePrice,
                    'low_price' => $lowestPrice,
                    'high_price' => $highestPrice,
                ]
            );

        }



        $this->info('Prices data updated successfully');
    }
}
