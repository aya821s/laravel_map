<?php

namespace App\Http\Controllers;
use App\Models\Store;
use App\Models\Post;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $stores = Store::all();
        return view('stores.index', compact('stores'));
    }

    public function show(Store $store)
    {
        $posts = Post::has('store')->get();
        // $item =
        return view('stores.show', compact('store', 'posts',));
        // return view('stores.show', compact('store', 'posts', 'item'));
    }
}
