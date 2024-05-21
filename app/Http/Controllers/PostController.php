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
         $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->get();

         return view('posts.index', compact('posts'));
     }

     public function create()
     {
         return view('posts.create');
     }

     public function store(PostRequest $request)
     {
         $post = new Post();
         $post->price = $request->input('price');
         $post->description = $request->input('description');
         $post->is_soldout = $request->input('is_soldout');
         $post->is_anonymous = $request->input('is_anonymous');
         $post->user_id = Auth::id();

         if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/images');
            $post->image = basename($image_path);
        }
         $post->save();

         return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
     }
}
