<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DataControllers extends Controller
{
    //
    public function __invoke()
    {
        $data = Data::all();
        return response()->json($data);
    }
}
