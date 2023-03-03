<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $req)
    {
        $QR = DB::select('SELECT Pk_inventoryId FROM inventories LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId WHERE location_name = "E.R. ISO - Non Covid"');

        return response()->json($QR);
    }
}
