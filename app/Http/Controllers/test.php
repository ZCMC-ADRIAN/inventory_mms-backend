<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $request)
    {
        try {
            //get Series for ICS Number
            $getSeries = DB::select('SELECT series FROM `ics_series` ORDER BY created_at DESC LIMIT 1');

            foreach($getSeries as $num){
                $numSeries = $num->series;
            }

            if ($getSeries !== null) {
                $lastNumber = $numSeries;
                $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '0001';
            }

            return response()->json($nextNumber);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
            ]);
        }
    }
}
