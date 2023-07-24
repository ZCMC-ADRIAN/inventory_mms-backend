<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\ArticleRelation;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $request)
    {
        try {
            $editArticleTypes = DB::table('article_relation')
            ->join('articles', 'article_relation.Fk_articleId', '=', 'articles.Pk_articleId')
            ->join('types', 'article_relation.Fk_typeId', '=', 'types.Pk_typeId')
            ->select('type_name', 'types.Pk_typeId')
            ->where('article_name', 'Keyboard')
            ->whereNotNull('type_name')
            ->groupBy('type_name', 'types.Pk_typeId');
            
            $secondData = DB::table('types')
            ->select('type_name', 'Pk_typeId')
            ->where('type_name', 'None');

            $mergedQuery = $editArticleTypes->union($secondData)->get();

            return response()->json($mergedQuery);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
            ]);
        }
    }
}
