<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Store;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $posts = Post::with('user')->get()->sortByDesc('created_at');
        // dd($posts);
        return view('items.show', compact('item', 'stores', 'posts'));
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

    }
