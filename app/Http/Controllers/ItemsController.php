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
                $items = DB::select("SELECT DISTINCT property_no FROM inventories WHERE property_no LIKE ? UNION SELECT DISTINCT `serial` FROM inventories WHERE `serial` LIKE ? UNION SELECT DISTINCT article_name FROM articles WHERE article_name LIKE ?", ["%$q%", "%$q%", "%$q%"]);
                return response()->json($items);
            } else {
                # code... SELECT COUNT(items.item_name) as total, items.item_name from items GROUP by items.item_name;
                $items = DB::select("SELECT DISTINCT property_no FROM inventories WHERE property_no IS NOT NULL UNION SELECT DISTINCT `serial` FROM inventories WHERE `serial` IS NOT NULL UNION SELECT DISTINCT article_name FROM articles;");
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
                SELECT DISTINCT
                items.Pk_itemId,
                a.article_name AS 'item name',
                a.article_name AS 'article name',
                b.brand_name,
                m.manu_name,
                t.type_name,
                items.remarks,
                v.variety,
                co.country,
                items.details2,
                items.warranty,
                items.acquisition_date,
                items.expiration
            FROM `items`
            LEFT JOIN article_relation art ON items.Fk_article_relationId = art.Pk_article_relationId
            LEFT JOIN brands b ON items.Fk_brandId = b.Pk_brandId
            LEFT JOIN manufacturers m ON items.Fk_manuId = m.Pk_manuId
            LEFT JOIN types t ON art.Fk_typeId = t.Pk_typeId
            LEFT JOIN articles a ON art.Fk_articleId = a.Pk_articleId
            LEFT JOIN variety v ON items.Fk_varietyId = v.Pk_varietyId
            LEFT JOIN countries co ON items.Fk_countryId = co.Pk_countryId
            LEFT JOIN inventories inv ON items.Pk_itemId = inv.Fk_itemId
            WHERE a.article_name LIKE ? OR `serial` LIKE ? OR property_no LIKE ?
            ORDER BY items.created_at DESC;
            ", ["%$q%", "%$q%", "%$q%"]);
                return response()->json($items);
            } 

        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function query($id)
    {
        try {
            $items = DB::select("SELECT 
            b.brand_name as 'Brand',
            arts.article_name as 'Article',
            t.type_name as 'Type', 
            s.status_name as 'Status',
            i.model as 'Model', 
            m.manu_name as 'Manufacturer',
            su.supplier as 'Suplier', 
            u.unit as 'Unit', 
            v.variety as 'Variety',
            c.country as 'Country origin', 
            i.details2 as 'Details',
            i.other as 'Other Details', 
            i.warranty as 'Warranty',
            i.acquisition_date as 'Acquisition Date',
            i.expiration as 'Expiration Date',
            i.fundSource as 'Fund Source',
            i.remarks as 'Remarks',
            i.created_at as 'Created at',
            i.accessories as 'Accessories'
            FROM `items` i JOIN article_relation ar ON i.Fk_article_relationId = ar.Pk_article_relationId
            LEFT JOIN articles arts ON ar.Fk_articleId = arts.Pk_articleId
            LEFT JOIN types t ON ar.Fk_typeId = t.Pk_typeId
            LEFT JOIN status s ON i.Fk_statusId = s.Pk_statusId 
            LEFT JOIN manufacturers m ON i.Fk_manuId = m.Pk_manuId 
            LEFT JOIN suppliers su ON i.Fk_supplierId = su.Pk_supplierId 
            LEFT JOIN units u ON i.Fk_unitId = u.Pk_unitId 
            LEFT JOIN variety v ON i.Fk_varietyId = v.Pk_varietyId 
            LEFT JOIN brands b ON i.Fk_brandId = b.Pk_brandId 
            LEFT JOIN countries c ON i.Fk_countryId = c.Pk_countryId
            WHERE i.Pk_itemId = ?;", [$id]);
            return response($items);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th
            ]);
        }
    }
}