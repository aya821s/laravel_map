<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store($post_id)
     {
         Auth::user()->favorite_posts()->attach($post_id);

         return back();
     }

     public function destroy($post_id)
     {
         Auth::user()->favorite_posts()->detach($post_id);

         return back();
     }
}
