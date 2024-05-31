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
        $posts = Post::all()->sortByDesc('created_at');
        return view('items.show', compact('item', 'stores', 'posts'));
    }

    public function store(Request $request)
     {
         $post = new Item();
         $post->name = $request->input('name');
         $post->save();

         return redirect()->route('items.index')->with('flash_message', '食材を追加しました。');
     }

     public function follow()
     {
         $user = Auth::user();

         $follow_items = $user->follow_items;

         return view('items.follow', compact('follow_items'));
     }

    }
