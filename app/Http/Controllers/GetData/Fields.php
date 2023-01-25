<?php

namespace App\Http\Controllers\GetData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Fields extends Controller
{
    public function get_article(){
        try {
            $article = DB::table('articles')->select('article_name')->get();

            return response()->json($article);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function get_types(Request $req){
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

    public function get_status(){
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

    public function get_supplier(Request $req){
        try {
            $mode = null;
            if($req->acquiMode === 'Purchase'){
                $mode = 0;
            }else if($req->acquiMode === 'Donation'){
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
}
