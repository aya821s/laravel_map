<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store($item_id)
     {
         Auth::user()->follow_items()->attach($item_id);

         return back();
     }

     public function destroy($item_id)
     {
         Auth::user()->follow_items()->detach($item_id);

         return back();
     }
}
