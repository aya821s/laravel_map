<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage()
     {
         $user = Auth::user();

         return view('users.mypage', compact('user'));
     }

     public function edit(User $user)
    {
         $user = Auth::user();

         return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
         $user = Auth::user();

         $user->name = $request->input('name') ? $request->input('name') : $user->name;
         $user->email = $request->input('email') ? $request->input('email') : $user->email;
         $user->description = $request->input('description') ? $request->input('description') : $user->description;
         $user->update();

         return to_route('mypage')->with('flash_message', 'マイページを編集しました。');
    }
}
