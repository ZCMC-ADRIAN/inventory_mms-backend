<?php

namespace App\Http\Controllers\helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryExtract extends Controller
{
    //
    public function invExtract(Request $request){
        try{
            DB::beginTransaction();
            DB::beginTransaction();
            $file=$request->file('csv');

            $header = null;
            $data = array();
            $trying;
            $table = array();
            if(!file_exists($file)||!is_readable($file)) {
                return 'Error Reading the csv file for message migrate';
            }

            if(($handle = fopen($file,'r')) !==false){
                while(($row = fgetcsv($handle,1000))!==false){
                    
                    if(!$header)
                        $header = $row;
                    else
                        $data[] = array_combine($header,$row);
                }
            }

             fclose($handle);
            for($i = 0 ; $i <count($data); $i++){
                $dataa = DB::select("
                        SELECT Pk_itemId,items.*, CONCAT(
                        REPLACE(COALESCE(articles.article_name, ''), ' ', ''),
                        REPLACE(COALESCE(types.type_name, ''), ' ', ''),
                        REPLACE(COALESCE(items.model, ''), ' ', ''),
                        REPLACE(COALESCE(variety.variety, ''), ' ', ''),
                        REPLACE(COALESCE(items.details2, ''), ' ', ''),
                        REPLACE(COALESCE(items.other, ''), ' ', '')
                        ) as Concatvalue
                        FROM `items`
                        LEFT JOIN types ON Fk_typeId = types.Pk_typeId 
                        LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId 
                        LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId 
                        HAVING Concatvalue = ?;
                    ",[str_replace(" ","",$data[$i]["Item Description"])]);
                    $dataa = $dataa[0]||null;
                if($dataa){
                    echo ('column no: ' . $i+2 . $data[$i]["Item Description"] . "   " ."PK IN DB is: ". get_object_vars($dataa)["Pk_itemId"] . "|||");
                }
            }

            fclose($handle);
            DB::commit();
        }catch (\Throwable $th) {
            echo("ERRROR at column".$i+2);
            dd($dataa);
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th -> getMessage(),
            ]);
        } 
    }
}
