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
}
