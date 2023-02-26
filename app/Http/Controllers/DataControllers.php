<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DataControllers extends Controller
{
    //
    public function __invoke()
    {
        $response = Http::get('https://cspf-dev-challenge.herokuapp.com/');
        $data = json_decode($response->body())->data;
        return response()->json($data);
    }
}
