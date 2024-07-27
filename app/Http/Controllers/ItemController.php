<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Store;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Price;
use App\Models\MonthlyPrice;
use App\Models\StorePrice;
use Illuminate\Support\Facades\DB;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function show(Item $item)
    {
        $stores = Store::all();
        //dd($stores);
        //$posts = Post::all()->sortByDesc('created_at');
        $posts = Post::with('user')
                ->where('item_id', $item->id)
                ->get()
                ->sortByDesc('created_at');
        // dd($posts);

        $price_data = StorePrice::select('store_id', 'average_price', 'high_price', 'low_price', 'date', 'created_at')
                ->where('item_id', $item->id)
                ->orderBy('date', 'asc')
                ->get();

        $lastRecord = $price_data->last();
        $created_at = $lastRecord ? $lastRecord->created_at : null;

        return view('items.show', compact('item', 'stores', 'posts', 'price_data', 'created_at'));
        }

    public function store(Request $request)
     {
         $item = new Item();
         $item->name = $request->input('name');
         if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/item_images');
            $item->image = basename($image_path);
         }
         $item->save();

         return redirect()->route('items.index')->with('flash_message', '食材を追加しました。');
     }

     public function follow()
     {
         $user = Auth::user();
         $follow_items = $user->follow_items;
         return view('items.follow', compact('follow_items'));
     }

     public function chart(Item $item)
    {
        $posts = Post::all();
        return view('items.chart', compact('item', 'posts'));
    }

    public function batch(Item $item)
    {
        $data = Price::select('average_price', 'high_price', 'low_price', 'date', 'created_at')
            ->where('item_id', $item->id)
            ->orderBy('date', 'asc')
            ->get();
        $lastRecord = $data->last();
        $created_at = $lastRecord ? $lastRecord->created_at : null;

        $monthly_data = MonthlyPrice::select('average_price', 'high_price', 'low_price', 'month', 'created_at')
            ->where('item_id', $item->id)
            ->orderBy('month', 'asc')
            ->get();

        return view('items.batch', [
            'average_price' => $data->pluck('average_price'),
            'high_price' => $data->pluck('high_price'),
            'low_price' => $data->pluck('low_price'),
            'days' => $data->pluck('date'),
            'created_at' => $created_at,
            'm_average_price' => $monthly_data->pluck('average_price'),
            'm_high_price' => $monthly_data->pluck('high_price'),
            'm_low_price' => $monthly_data->pluck('low_price'),
            'month' => $monthly_data->pluck('month'),
            'item' => $item,
        ]);

        // $monthly_data = Price::select(
        //     DB::raw('MONTH(date) as month'),
        //     DB::raw('YEAR(date) as year'),
        //     DB::raw('ROUND(AVG(average_price), 1) as average_price'),
        //     DB::raw('MAX(high_price) as high_price'),
        //     DB::raw('MIN(low_price) as low_price')
        //     )
        //     ->where('item_id', $item->id)
        //     ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'))
        //     ->orderBy(DB::raw('YEAR(date)'), 'asc')
        //     ->orderBy(DB::raw('MONTH(date)'), 'asc')
        //     ->get();

        //     $monthly_data_array = $monthly_data->toArray();
        //     $monthly_data_json = json_encode($monthly_data_array);

        // return view('items.batch', [
        //     'average_price' => $data->pluck('average_price'),
        //     'high_price' => $data->pluck('high_price'),
        //     'low_price' => $data->pluck('low_price'),
        //     'days' => $data->pluck('date'),
        //     'created_at' => $created_at,
        //     'monthly_data_json' => $monthly_data_json,
        //     'item' => $item,
        // ]);
    }
}
