<?php

namespace App\Http\Controllers;

use App\Models\item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->has('q')) {
                # search item
                $q = $request->input('q');
                $items = DB::select("SELECT COUNT(items.item_name) as total, items.item_name from items WHERE items.item_name LIKE ? GROUP by items.item_name;", ["%$q%"]);
                return response()->json($items);
            } else {
                # code... SELECT COUNT(items.item_name) as total, items.item_name from items GROUP by items.item_name;
                $items = DB::select("SELECT COUNT(items.item_name) as total, items.item_name from items GROUP by item_name;");
                return response()->json($items);
            }
        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'status' => 500,
                'message' => $th
            ]);
        }
    }
    public function multiq(Request $request)
    {
        
        try {
                if($request->has('q')){
                    # search item
                    $q = $request->input('q');
                    $items = DB::select("
                    SELECT items.Pk_itemId, items.item_name, b.brand_name, m.manu_name, 
                    t.type_name, a.article_name, items.remarks FROM `items` 
                    LEFT JOIN brands b on items.Fk_brandId = b.Pk_brandId 
                    LEFT JOIN manufacturers m on items.Fk_manuId = m.Pk_manuId 
                    LEFT JOIN types t on items.Fk_typeId = t.Pk_typeId 
                    LEFT JOIN articles a on t.Fk_articleId = a.Pk_articleId WHERE items.item_name LIKE ?;",["%$q%"]);
                    return response()->json($items);
                }else{
                    $items = DB::select("
                    SELECT items.Pk_itemId, items.item_name, b.brand_name, m.manu_name, 
                    t.type_name, a.article_name, items.remarks FROM `items` 
                    LEFT JOIN brands b on items.Fk_brandId = b.Pk_brandId 
                    LEFT JOIN manufacturers m on items.Fk_manuId = m.Pk_manuId 
                    LEFT JOIN types t on items.Fk_typeId = t.Pk_typeId 
                    LEFT JOIN articles a on t.Fk_articleId = a.Pk_articleId;");
                return response()->json($items);
                }
           
        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'status' => 500,
                'message' => $th
            ]);
        }
    }

    public function query(Request $request)
    {
        try {
            $items = DB::select("SELECT * FROM items WHERE item_Name LIKE '%?%'", $request["q"]);
            return response($items);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(item $item)
    {
        //
    }
}