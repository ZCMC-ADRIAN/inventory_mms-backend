<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $request)
    {
        try {

            // $items = DB::select('SELECT Fk_propertyId, Pk_inventoryId, `serial`, barcode, location_name, person_name, code, series, area_code FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON itemcateg.Pk_itemCategId = items.Fk_itemCategId LEFT JOIN propertyno ON propertyno.Pk_propertyId = inventories.Fk_propertyId LEFT JOIN par_series ON propertyno.Fk_parId = par_series.Pk_parId WHERE Pk_itemId = ?', ["55"]);
            
            // foreach($items as $info){
            //     $propertId = $info->Fk_propertyId;
                
            //     $year = '2023';
            //     $categ_code = $info->code;
            //     $series = $info->series;
            //     $area_code = $info->area_code;
            // }

            // $propertyNum = $year.'-'.$categ_code.'-'.$series.'-'.$area_code;

            // return response()->json($propertyNum);

                
            $cost = 10000;

            if ($cost >= 50000) {
                $getSeries = DB::table('par_series')->select('series')->orderBy('created_at', 'desc')->first();
            
                if ($getSeries !== null) {
                    $series = $getSeries->series + 1;
                } else {
                    $series = 1;
                }
            } elseif ($cost < 50000) {
                $getSeries = DB::table('ics_series')->select('series')->orderBy('created_at', 'desc')->first();
            
                if ($getSeries !== null) {
                    $series = $getSeries->series + 1;
                } else {
                    $series = 1;
                }
            }
            

            return response()->json($series);

        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'status' => 500,
                'message' => $th
            ]);
        }
    }
}
