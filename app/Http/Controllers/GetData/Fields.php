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
            $article = DB::table('articles')->select('*')->get();

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

            $articleTypes = null;
            $editTypes = null;
            $editArticleTypes = null;
            $mergedQuery = null;
            
            if(!empty($req->article)) {
                $articleTypes = DB::table('article_relation')
                    ->join('articles', 'article_relation.Fk_articleId', '=', 'articles.Pk_articleId')
                    ->join('types', 'article_relation.Fk_typeId', '=', 'types.Pk_typeId')
                    ->where('article_name', $req->article)
                    ->whereNotNull('type_name')
                    ->groupBy('type_name', 'types.Pk_typeId')
                    ->select('type_name', 'types.Pk_typeId')
                    ->get();
            }

            if(!empty($req->editArticle)){
                $secondData = DB::table('types')
                ->select('type_name', 'Pk_typeId')
                ->where('type_name', 'None');

                $editArticleTypes = DB::table('article_relation')
                ->join('articles', 'article_relation.Fk_articleId', '=', 'articles.Pk_articleId')
                ->join('types', 'article_relation.Fk_typeId', '=', 'types.Pk_typeId')
                ->select('type_name', 'types.Pk_typeId')
                ->where('article_name', $req->editArticle)
                ->whereNotNull('type_name');

                $mergedQuery = $secondData->union($editArticleTypes)->get();
            }
            
            return response()->json([
                'articleTypes' => $articleTypes,
                'editArticleTypes' => $mergedQuery
            ]);
            
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
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
            if ($req->acquiMode === 'Regular') {
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

    public function get_cluster()
    {
        try {
            $clusters = DB::table('fundcluster')->select('*')->get();

            return response()->json($clusters);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
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
                $getSeries = DB::table('par_property_series')->select('series')->orderBy('created_at', 'desc')->first();
            
                if ($getSeries !== null) {
                    $lastNumber = $getSeries->series;
                    $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $nextNumber = '0001';
                }
                
            } elseif ($cost < 50000) {
                $getSeries = DB::table('ics_property_series')->select('series')->orderBy('created_at', 'desc')->first();
            
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

    public function getNumSeries(Request $req){
        try {

            $cost = $req->cost;
            $numSeries = null;

            if($cost >= 50000){
                //get Series for PAR Number
                $getSeries = DB::select('SELECT series FROM `series` WHERE attributes = "PAR" ORDER BY created_at DESC LIMIT 1');

                foreach($getSeries as $num){
                    $numSeries = $num->series;
                }

                if ($getSeries !== null) {
                    $lastNumber = $numSeries;
                    $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $nextNumber = '0001';
                }
            }elseif ($cost < 50000){
                //get Series for ICS Number
                $getSeries = DB::select('SELECT series FROM `series` WHERE attributes = "ICS" ORDER BY created_at DESC LIMIT 1');

                foreach($getSeries as $num){
                    $numSeries = $num->series;
                }

                if ($getSeries !== null) {
                    $lastNumber = $numSeries;
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

    public function getPrevNumSeries(Request $req){
        try {
            $itemId = $req->itemId;
            $assoc_id = $req->assoc_id;

            $cost = DB::table('items')
            ->where('Pk_itemId', $itemId)
            ->value('cost');
        
            // Determine which table to join based on the cost
            $joinTable = $cost >= 50000 ? 'par' : 'ics';
        
            // Fetch data from inventories table with appropriate join
            $checkingPO = DB::table('inventories')
            ->select('Fk_person_ID', 'po_number')
            ->leftJoin('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
            ->leftJoin('item_attributes', 'inventories.Fk_item_attributes', '=', 'item_attributes.id')
            ->leftJoin($joinTable, 'item_attributes.Fk_' . $joinTable . '_ID', '=', $joinTable . '.id')
            ->leftJoin('po_number', 'item_attributes.Fk_po_ID', '=', 'po_number.Pk_poId')
            ->where('Fk_itemId', $itemId)
            ->get();
            $assocIdInCheckingPO = false;

            foreach ($checkingPO as $entry) {
                if ($entry->Fk_person_ID == $assoc_id) {
                    $assocIdInCheckingPO = true;
                    break;
                }
            }

            if (!$assocIdInCheckingPO) {
                if($assoc_id !== null){
                        $condition = ($cost >= 50000) ? 'PAR' : 'ICS';
                        $data = DB::select("SELECT series FROM series WHERE attributes = '$condition' ORDER BY created_at DESC LIMIT 1");
        
                        foreach ($data as $num) {
                            $numSeries = $num->series;
                        }
        
                        if ($data !== null) {
                            $lastNumber = $numSeries;
                            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                        } else {
                            $nextNumber = '0001';
                        }
        
                        return response()->json($nextNumber);
                    } else {
                        return response()->json([
                            'error' => 'assoc_id already exists in the list of Fk_person_ID from checkingPO'
                        ]);
                    }
                }

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

    public function getPrevSeries(Request $req){
        try {
            $itemId = $req->itemId;
            $numSeries= null;

            $prev = DB::select('SELECT DISTINCT IF(par_property_series.series IS NOT NULL, par_property_series.series, ics_property_series.series) AS series FROM inventories LEFT JOIN items ON items.Pk_itemId = inventories.Fk_itemId LEFT JOIN propertyno ON inventories.Fk_propertyId = propertyno.Pk_propertyId LEFT JOIN par_property_series ON propertyno.Fk_parId = par_property_series.id LEFT JOIN ics_property_series ON propertyno.Fk_icsId = ics_property_series.id WHERE Pk_itemId = ?', ["$itemId"]);

            foreach($prev as $num){
                $numSeries = $num->series;
            }

            if ($prev !== null) {
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

    public function getPrevCode(Request $req){
        try {
            $itemId = $req->itemId;

            $prevCode = DB::select('SELECT code FROM itemcateg LEFT JOIN items ON itemcateg.Pk_itemCategId = items.Fk_itemCategId WHERE Pk_itemId = ?', ["$itemId"]);

            return response()->json($prevCode);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function getEquipments(Request $req){
        try {
            $input = $req->equipment;
        
            $data = DB::table('inventories')
                ->select('articles.article_name', 'types.type_name', 'items.model', 'variety.variety', 'items.details2')
                ->distinct()
                ->leftJoin('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                ->leftJoin('locat_man', 'inventories.Fk_locatmanId', '=', 'locat_man.Pk_locatmanId')
                ->leftJoin('location', 'locat_man.Fk_locationId', '=', 'location.Pk_locationId')
                ->leftJoin('article_relation', 'items.Fk_article_relationId', '=', 'article_relation.Pk_article_relationId')
                ->leftJoin('types', 'article_relation.Fk_typeId', '=', 'types.Pk_typeId')
                ->leftJoin('articles', 'article_relation.Fk_articleId', '=', 'articles.Pk_articleId')
                ->leftJoin('variety', 'items.Fk_varietyId', '=', 'variety.Pk_varietyId')
                ->leftJoin('associate', 'locat_man.Fk_assocId', '=', 'associate.Pk_assocId')
                ->get();
        
            return response()->json($data);
        
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }        
    }

    public function getPO(){
        try {
            $PO = DB::table('po_number')->select('po_number')->get();

            return response()->json($PO);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }

    public function getPAR(){
        try {
            $par = DB::table('par')->select('par_number')->get();

            return response()->json($par);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }
}
