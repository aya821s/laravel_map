<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index()

     {
        return view('web.index');
     }
}
