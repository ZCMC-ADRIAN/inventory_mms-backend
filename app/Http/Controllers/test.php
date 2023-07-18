<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsertAssocRelation;
use App\Models\InsertPARNum;
use App\Models\InsertPARSeries;
use App\Models\InsertPropertyNo;
use App\Models\InsertICSSeries;
use App\Models\ArticleRelation;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $req){
        try {
            $articles = DB::select('SELECT DISTINCT article_name FROM articles');
            $data = [];

            foreach ($articles as $article) {
                $articleName = $article->article_name;
                $artIds = DB::select('SELECT Pk_articleId FROM articles WHERE article_name = ?', [$articleName]);
            
                $extractedIds = array_map(function ($item) {
                    return $item->Pk_articleId;
                }, $artIds);
            
                $data[] = [
                    'article_name' => $articleName,
                    'Pk_articleIds' => $extractedIds,
                ];
            
                $typeId = DB::select('SELECT DISTINCT type_name, MAX(Pk_typeId) AS Pk_typeId
                    FROM types
                    LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId
                    WHERE article_name = ?
                    GROUP BY type_name
                ', ["$articleName"]);
            
                $insertData = [];
            
                foreach ($typeId as $result) {
                    $resId = $result->Pk_typeId;
            
                    foreach ($extractedIds as $articleId) {
                        $insertData[] = [
                            'Fk_articleId' => $articleId,
                            'Fk_typeId' => $resId,
                        ];
                    }
                }
            
                if (!empty($insertData)) {
                    DB::table('article_relation')->insert($insertData);
                }
            }            

            return response('Success');

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
            ]);
        }
    }
}
