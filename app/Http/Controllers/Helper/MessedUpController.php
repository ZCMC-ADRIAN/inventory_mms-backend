<?php

namespace App\Http\Controllers\helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MessedUpController extends Controller
{
    //
    public function messup(Request $request)
    {
        try{
            $file=$request->file('csv');

            $header = null;
            $data = array();
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

                    //trim
                    // if(trim($row[2]," ") == trim('Table               '," ")){
                        
                    //     $table[] = array_combine($header,$row);
                    // }
                }
            }
            fclose($handle);
           for ($i = 0; $i < count($data); $i ++)
            {
                // $message = new Messages;
                // $message->PK_message_ID        = $data[$i]['PK_message_ID'];
                // $message->message_comments     = $data[$i]['message_comments'];
                // $message->FK_cases_ID          = $data[$i]['FK_cases_ID'];
                // $message->FK_user_ID           = $data[$i]['FK_user_ID'];
                // $message->message_created_at   = date('Y-m-d H:m:s', strtotime($data[$i]["message_created_at"]));
                // $message->save();
                   $article=null;
                   $type=null;
                   $model=null;
                   $variety=null;
                   $details=null;
                   $other=null;
                   $status=null;
                   $brand=null;
                   $manu=null;
                   $country=null;
                   $waranty=null;
                   $unit=null;

                $dataa = DB::table('items')
                    ->select()
                    ->where('item_name', '=', $data[$i]["Item Description"])->first();
                //item description check if new then create if not then find the existing and 
                if($dataa){
                    dd(get_object_vars($dataa)["Fk_statusId"]);
                }
                //->get the id of type, model, variety, deteails2 other desc. then proceed

                //check if desc has a value

                //if it existing

                //get all of the property of exisiting !!
                //including the id of type, model, Article, deteails2 other desc.
                //and make the set for the NEW ITEM and SAVE.

                //if not exisiting !!
                //create new Item
                //check if Article is existing if yes get the id
                //checkalso if Type of the Article is existing if no, make one and store it with the article
                //check if model is existing if yes get the id
                //check if variety is existing if yes get the id

            }
            }catch (\Throwable $th) {

            return response()->json([
                'status' => 500,
                'message' => $th -> getMessage(),
            ]);
        } 
    }
            
}
