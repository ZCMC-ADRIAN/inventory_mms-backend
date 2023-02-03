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
                $items = DB::select("SELECT COUNT(items.item_name) as total, items.item_name from items WHERE items.item_name LIKE ? AND items.isStored IS NULL GROUP by items.item_name;", ["%$q%"]);
                return response()->json($items);
            } else {
                # code... SELECT COUNT(items.item_name) as total, items.item_name from items GROUP by items.item_name;
                $items = DB::select("SELECT COUNT(items.item_name) as total, items.item_name from items WHERE items.isStored IS NULL  GROUP by item_name;");
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
            if ($request->has('q')) {
                # search item
                $q = $request->input('q');
                $items = DB::select("
                    SELECT items.Pk_itemId, items.item_name, b.brand_name, m.manu_name, 
                    t.type_name, a.article_name, items.remarks FROM `items` 
                    LEFT JOIN brands b on items.Fk_brandId = b.Pk_brandId 
                    LEFT JOIN manufacturers m on items.Fk_manuId = m.Pk_manuId 
                    LEFT JOIN types t on items.Fk_typeId = t.Pk_typeId 
                    LEFT JOIN articles a on t.Fk_articleId = a.Pk_articleId WHERE items.item_name LIKE ? AND items.isStored IS NULL;", ["%$q%"]);
                return response()->json($items);
            } else {
                $items = DB::select("
                    SELECT items.Pk_itemId, items.item_name, b.brand_name, m.manu_name, 
                    t.type_name, a.article_name, items.remarks FROM `items` 
                    LEFT JOIN brands b on items.Fk_brandId = b.Pk_brandId 
                    LEFT JOIN manufacturers m on items.Fk_manuId = m.Pk_manuId 
                    LEFT JOIN types t on items.Fk_typeId = t.Pk_typeId 
                    LEFT JOIN articles a on t.Fk_articleId = a.Pk_articleId WHERE items.isStored IS NULL;");
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

    public function query($id)
    {
        try {
            $items = DB::select("SELECT i.item_name as 'Item name', 
            b.brand_name as 'Brand',
            art.article_name as 'Article',
            t.type_name as 'Item name', 
            s.status_name as 'Status',
            i.model as 'Model', 
            m.manu_name as 'Manufacturer',
            su.supplier as 'Suplier', 
            u.unit as 'Unit', 
            v.variety as 'Variety',
            c.country as 'Country origin', 
            i.details2 as 'Details',
            i.other as 'Other Details', 
            i.serial as 'Serial No.',
            i.warranty as 'Warranty',
            i.acquisition_date as 'Acquisition Date',
            i.property_no as 'Property No',
            i.expiration as 'Expiration Date',
            i.fundSource as 'Fund Source',
            i.remarks as 'Remarks',
            i.created_at as 'Created at'
            FROM `items` i JOIN types t on i.Fk_typeId = t.Pk_typeId 
            LEFT JOIN status s ON i.Fk_statusId = s.Pk_statusId 
            LEFT JOIN manufacturers m ON i.Fk_manuId = m.Pk_manuId 
            LEFT JOIN suppliers su ON i.Fk_supplierId = su.Pk_supplierId 
            LEFT JOIN units u ON i.Fk_unitId = u.Pk_unitId 
            LEFT JOIN variety v ON i.Fk_varietyId = v.Pk_varietyId 
            LEFT JOIN brands b ON i.Fk_brandId = b.Pk_brandId 
            LEFT JOIN countries c ON i.Fk_countryId = c.Pk_countryId 
            LEFT JOIN articles art ON t.Fk_articleId = art.Pk_articleId
            WHERE i.Pk_itemId = ?;", [$id]);
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