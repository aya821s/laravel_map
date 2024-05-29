<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Pagination\Paginator;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword !== null) {
            $stores = Store::where('name', 'like', "%{$keyword}%")->sortable()->paginate(10);
            $total_count = $stores->total();
        }
        else {
            $stores = Store::sortable()->paginate(10);
            $total_count = "";
        }

        return view('admin.stores.index', compact('stores', 'total_count', 'keyword'));
    }

    public function show(Store $store)
    {
        return view('admin.stores.show', compact('store'));
    }

    public function create()
     {
         return view('admin.stores.create');
     }

     public function store(Request $request)
     {
         $store = new Store();
         $store->name = $request->input('name');
         $store->description = $request->input('description');
         $store->opening_time = $request->input('opening_time');
         $store->closing_time = $request->input('closing_time');
         $store->postal_code = $request->input('postal_code');
         $store->address = $request->input('address');
         $store->phone_number = $request->input('phone_number');
         $store->address = $request->input('address');
         $store->homepage = $request->input('homepage');

         if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/store_images');
            $store->image = basename($image_path);
         }
         $store->save();

         return redirect()->route('admin.stores.index')->with('flash_message', '店舗の新規登録が完了しました。');
     }

    public function edit(Store $store)
    {
         return view('admin.stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
         $store->name = $request->input('name') ? $request->input('name') : $store->name;
         $store->description = $request->input('description') ? $request->input('description') : $store->description;
         $store->opening_time = $request->input('opening_time') ? $request->input('opening_time') : $store->opening_time;
         $store->closing_time = $request->input('closing_time') ? $request->input('closing_time') : $store->closing_time;
         $store->postal_code = $request->input('postal_code') ? $request->input('postal_code') : $store->postal_code;
         $store->address = $request->input('address') ? $request->input('address') : $store->address;
         $store->phone_number = $request->input('phone_number') ? $request->input('phone_number') : $store->phone_number;
         $store->address = $request->input('address') ? $request->input('address') : $store->address;
         $store->homepage = $request->input('homepage') ? $request->input('homepage') : $store->homepage;

         if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/store_images');
            $store->image = basename($image_path);
         }

         $store->update();

         return to_route('admin.stores.show', compact('store'))->with('flash_message', '店舗情報を編集しました。');
    }

    public function destroy(Request $request, Store $store)
     {
        $store->delete();
        return redirect('admin.stores.index');
     }
}
