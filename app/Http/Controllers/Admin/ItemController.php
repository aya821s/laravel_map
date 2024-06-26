<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::all();
        return view('admin.items.index', compact('items'));
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

         return redirect()->route('admin.items.index')->with('flash_message', '食材を追加しました。');
     }

    public function edit(Item $item)
     {
        return view('admin.items.edit', compact('item'));
     }

     public function update(Request $request, Item $item)
     {

         $item->name = $request->input('name');
         if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/item_images');
            $item->image = basename($image_path);
         }
         $item->save();

         return redirect()->route('admin.items.index')->with('flash_message', '食材を編集しました。');
     }

     public function destroy(Item $item) {

        $item->delete();
        return redirect()->route('admin.items.index')->with('flash_message', '食材を削除しました。');
    }
}
