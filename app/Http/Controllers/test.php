<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $req){
        $status = DB::table('status')
        ->select(DB::raw('distinct(status_name)'))->get();

        return response()->json($status);
    }
}
