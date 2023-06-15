<?php

namespace App\Http\Controllers\GetData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Fields extends Controller
{
    public function get_article()
    {
        try {
            $article = DB::table('articles')->select('article_name')->get();

            return response()->json($article);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function get_types(Request $req)
    {
        try {
            $type = DB::table('types')
                ->join('articles', 'types.Fk_articleId', '=', 'articles.Pk_articleId')
                ->select(DB::raw('distinct(type_name)'))->where('article_name', $req->article)->whereNotNull('type_name')->get();

            return response()->json($type);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function get_status()
    {
        try {
            $status = DB::table('status')
                ->select(DB::raw('distinct(status_name)'))->get();

            return response()->json($status);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function get_supplier(Request $req)
    {
        try {
            $mode = null;
            if ($req->acquiMode === 'Purchase') {
                $mode = 0;
            } else if ($req->acquiMode === 'Donation') {
                $mode = 1;
            }

            $supplier = DB::table('suppliers')
                ->select('supplier')
                ->where('mode', $mode)->get();

            return response()->json($supplier);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function editDetails(Request $req)
    {
        try {
            $itemId = $req->itemId;

            $edit = DB::select('SELECT * FROM items LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN manufacturers ON items.Fk_manuId = manufacturers.Pk_manuId LEFT JOIN suppliers ON items.Fk_supplierId = suppliers.Pk_supplierId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN brands ON items.Fk_brandId = brands.Pk_brandId LEFT JOIN countries ON items.Fk_countryId = countries.Pk_countryId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId WHERE Pk_itemId = ?',["$itemId"]);

            return response()->json($edit);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function getSeries(Request $req){
        try {
            $cost = $req->cost;
            
            if ($cost >= 50000) {
                $getSeries = DB::table('par_series')->select('series')->orderBy('created_at', 'desc')->first();
            
                if ($getSeries !== null) {
                    $lastNumber = $getSeries->series;
                    $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $nextNumber = '0001';
                }
                
            } elseif ($cost < 50000) {
                $getSeries = DB::table('ics_series')->select('series')->orderBy('created_at', 'desc')->first();
            
                if ($getSeries !== null) {
                    $lastNumber = $getSeries->series;
                    $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $nextNumber = '0001';
                }
            }
            
            return response()->json($nextNumber);
            
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function getICSNumSeries(){
        try {
            //get Series for ICS Number
            $getSeries = DB::select('SELECT series FROM `ics_series` ORDER BY created_at DESC');

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

    public function getCost(Request $req){
        try {
            $itemId = $req->itemId;

            $cost = DB::table('items')->select('cost')->where('Pk_itemId', $itemId)->get();

            return response()->json($cost);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function getCode(Request $req){
        try {
            $category = $req->categ;

            $categCode = DB::table('itemcateg')->select('code')->where('itemCateg_name', $category)->get();

            return response()->json($categCode);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function getPrev(Request $req){
        try {
            $itemId = $req->itemId;

            $prev = DB::select('SELECT DISTINCT IF(par_series.series IS NOT NULL, par_series.series, ics_series.series) AS series, code FROM inventories LEFT JOIN items ON items.Pk_itemId = inventories.Fk_itemId LEFT JOIN itemcateg ON itemcateg.Pk_itemCategId = items.Fk_itemCategId LEFT JOIN propertyno ON inventories.Fk_propertyId = propertyno.Pk_propertyId LEFT JOIN par_series ON propertyno.Fk_parId = par_series.Pk_parId LEFT JOIN ics_series ON propertyno.Fk_icsId = ics_series.Pk_icsId WHERE Pk_itemId = ?', ["$itemId"]); 

            return response()->json($prev);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
            ]);
        }
    }
}
