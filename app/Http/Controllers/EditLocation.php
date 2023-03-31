<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Models\Associate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditLocation extends Controller
{
    public function editLocation(Request $req){
        try {
            


        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }
}
