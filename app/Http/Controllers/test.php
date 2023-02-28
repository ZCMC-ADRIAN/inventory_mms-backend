<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $req)
    {
        $location = DB::table('location')->select('location_name')->get();
            
        return response()->json($location);
    }
}
