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
                $items = DB::select("SELECT COUNT(articles.article_name) as total, articles.article_name from articles WHERE articles.article_name LIKE ? GROUP by articles.article_name;", ["%$q%"]);
                return response()->json($items);
            } else {
                # code... SELECT COUNT(items.item_name) as total, items.item_name from items GROUP by items.item_name;
                $items = DB::select("SELECT COUNT(articles.article_name) as total, articles.article_name from articles  GROUP by article_name;");
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
                    SELECT DISTINCT CONCAT_WS(' ', article_name, type_name, model, variety, details2) AS `desc`, article_name
                    FROM `items` 
                    LEFT JOIN brands on items.Fk_brandId = brands.Pk_brandId 
                    LEFT JOIN manufacturers on items.Fk_manuId = manufacturers.Pk_manuId
                    LEFT JOIN types on items.Fk_typeId = types.Pk_typeId 
                    LEFT JOIN articles on types.Fk_articleId = articles.Pk_articleId 
                    LEFT JOIN variety on items.Fk_varietyId = variety.Pk_varietyId 
                     WHERE article_name LIKE ? ORDER BY items.created_at DESC;", ["%$q%"]);

                $data = array();
                $propertArray = array();

                foreach ($items as $a => $itemList) {
                    $itemDesc = $itemList->desc;
                    $itemArticle = $itemList->article_name;

                    $items = DB::select('SELECT Pk_itemId, article_name, type_name, brand_name, details2 FROM items LEFT JOIN brands ON items.Fk_brandId = brands.Pk_brandId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON articles.Pk_articleId = types.Fk_articleId WHERE article_name = ? ', ["$itemArticle"]);

                    $property = DB::select('SELECT GROUP_CONCAT(DISTINCT property_no SEPARATOR ", ") AS "propConcat" FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ?', ["$itemDesc"]);

                    foreach ($property as $prop => $propValue) {
                        array_push($propertArray, array("property_no" => get_object_vars($propValue)['propConcat']));
                    }

                    array_push($data, array("Pk_itemId" => get_object_vars($items[0])['Pk_itemId'], "item name" => get_object_vars($items[0])['article_name'], "article name" => get_object_vars($items[0])['article_name'], "brand_name" => get_object_vars($items[0])['brand_name'], "detaisl2" => get_object_vars($items[0])['details2'], "property" => $propertArray));

                    $propertArray = array();
                }

                return response()->json($data);
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
            $items = DB::select("SELECT 
            b.brand_name as 'Brand',
            art.article_name as 'Article',
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
}