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
            // $type = DB::table('article_relation')
            //     ->join('articles', 'article_relation.Fk_articleId', '=', 'articles.Pk_articleId')->join("types", 'article_relation.Fk_typeId', '=', 'types.Pk_typeId')
            //     ->select(DB::raw('distinct(type_name)'), 'types.Pk_typeId')->where('article_name', $req->article)->whereNotNull('type_name')->get();

            // return response()->json($type);

            $articleTypes = null;
            $peripArticleTypes = null;
            $addArticleTypes = null;
            $editTypes = null;

            $mergedQuery = null;
            
            if (!empty($req->article)) {
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
                ->whereNotNull('type_name')
                ->groupBy('type_name', 'types.Pk_typeId');
    
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
}
