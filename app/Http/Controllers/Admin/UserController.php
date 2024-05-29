<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword !== null) {
            $users = User::where('name', 'like', "%{$keyword}%")->sortable()->paginate(10);
            $total_count = $users->total();
        }
        else {
            $users = User::sortable()->paginate(10);
            $total_count = "";
        }

        return view('admin.users.index', compact('users', 'total_count', 'keyword'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function destroy(Request $request, User $user)
     {
        $user->delete();
        return redirect('admin.users.index');
     }
}
