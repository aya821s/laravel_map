<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index()

     {
        $user = Auth::user();
        $follow_items = $user->follow_items;

        $client = new Client();
        $response = $client->get('https://map.yahooapis.jp/weather/V1/place', [
            'query' => [
                'coordinates' => '139.732293,35.663613',
                'appid' => 'dj00aiZpPXYzdHBsa0FxemlBQSZzPWNvbnN1bWVyc2VjcmV0Jng9OGQ-',
                'output' => 'xml',
            ]
        ]);

        $xmlString = $response->getBody()->getContents();
        $xml = simplexml_load_string($xmlString);

        return view('web.index', [
            'weatherData' => $xml,
            'follow_items' => $follow_items,
        ]);
     }
}
