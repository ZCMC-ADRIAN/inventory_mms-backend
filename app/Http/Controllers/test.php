<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $req)
    {
        $currData = DB::select('SELECT * FROM inventories LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId WHERE Pk_inventoryId = ?', [10585
    ]);

        return response()->json($currData);
    }
}
