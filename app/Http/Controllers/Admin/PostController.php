<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
     {
         $posts = Post::all()->sortByDesc('created_at');

         return view('admin.posts.index', compact('posts'));
     }

     public function edit(Post $post)
     {
        return view('admin.posts.edit', compact('post'));
     }

     public function update(Request $request, Post $post)
     {
         $post->price = $request->input('price');
         $post->description = $request->input('description');
         $post->is_soldout = $request->input('is_soldout');
         $post->is_anonymous = $request->input('is_anonymous');

         if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/post_images');
            $post->image = basename($image_path);
         }
         $post->save();

         return redirect()->route('admin.posts.index')->with('flash_message', '投稿を編集しました。');
     }
}
