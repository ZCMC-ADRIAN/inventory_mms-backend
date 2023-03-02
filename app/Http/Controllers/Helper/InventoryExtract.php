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
                dd($data[$i]);
            }

            fclose($handle);
            DB::commit();
        }catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th -> getMessage(),
            ]);
        } 
    }
}
