<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $req)
    {
        $category = DB::table('itemcateg')->select('*')->where('itemCateg_name', 'Janitorial Equipment')->get();
        foreach ($category as $a){
            $categId = $a->Pk_itemCategId;
        }

        return response()->json($categId);
    }
}
