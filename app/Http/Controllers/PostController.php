<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index()
     {
        $posts = Post::with('user')
        ->orderByDesc('created_at')
        ->get();
         return view('posts.index', compact('posts'));
     }

     public function create()
     {
         return view('posts.create');
     }

     public function store(Request $request)
     {
         $post = new Post();
         $post->price = $request->input('price');
         $post->store_id = $request->input('store_id');
         $post->item_id = $request->input('item_id');
         $post->description = $request->input('description');
         $post->is_soldout = $request->input('is_soldout');
         $post->is_anonymous = $request->input('is_anonymous');
         $post->user_id = Auth::id();

         if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/post_images');
            $post->image = basename($image_path);
         }
         $post->save();

         return back()->with('flash_message', '投稿が完了しました。');
     }
}
