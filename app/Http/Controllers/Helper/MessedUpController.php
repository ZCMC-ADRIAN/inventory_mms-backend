<?php

namespace App\Http\Controllers\helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\InsertArticle;
use App\Models\InsertTypes;
use App\Models\InsertVariety;
use App\Models\InsertStatus;
use App\Models\InsertBrand;
use App\Models\InsertManu;
use App\Models\InsertItem;
use App\Models\InsertCountry;
use App\Models\InsertUnit;
class MessedUpController extends Controller
{
    //
    public function messup(Request $request)
    {
        try{
            DB::beginTransaction();
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
                //if it existing
                if($dataa){

                    $article=DB::table('types')
                    ->select()
                    ->where('Pk_typeId', '=', get_object_vars($dataa)["Fk_typeId"])->first();
                   //$article= get_object_vars($article)["Pk_typeId"];
                
                    //->get the id of type, model, variety, deteails2 other desc. then proceed
                    //$article= get_object_vars($dataa)["Article"];
                    $type= get_object_vars($dataa)["Fk_typeId"];
                    $variety= get_object_vars($dataa)["Fk_varietyId"];
                    $model=get_object_vars($dataa)["model"];
                    $details=get_object_vars($dataa)["details2"];
                    $other=get_object_vars($dataa)["other"];
                    //checkif props exist and stop
                    //status
                    $checkStatus=DB::table('status')
                    ->select()
                    ->where('status_name', '=', get_object_vars($dataa)["Status"])->first();
                    //brand
                    //manufacturer
                    //country
                    //warranty
                    //unit
                    //acquisition date
                }
                //check if Article is existing if yes get the id
                //checkalso if Type of the Article is existing if no, make one and store it with the article
                //check if model is existing if yes get the id
                //check if variety is existing if yes get the id
                else{
                    // $article;
                    // $type;
                    // $model;
                    // $variety;

                    $article = DB::table('articles')
                    ->select()
                    ->where('article_name', '=', $data[$i]["Article"])->first();
                    $type = DB::table('types')
                    ->select()
                    ->where('type_name', '=', $data[$i]["Type/Form"])->first();
                    $variety = DB::table('variety')
                    ->select()
                    ->where('variety', '=', $data[$i]["Variety/Color"])->first();
                    
                    //->if the article existing get the id;
                    // get_object_vars($dataa)["Fk_statusId"];
                    if($article){
                        $article = get_object_vars($article)["Pk_articleId"];
                        // echo 'existing saved'. $article;
                    }else{
                        $article = new InsertArticle();
                        $article->article_name = $data[$i]["Article"];
                        $article->save();
                        $article = $article->Pk_articleId;
                        // $article = InsertArticle::create([
                        //     'article_name'=>$data[$i]["Article"],
                        // ]);
                        // dd($article);
                    }
                    if($type){
                        $type = get_object_vars($type)["Pk_typeId"];
                    }else{
                        $type = InsertTypes::create([
                            'type_name'=>$data[$i]["Type/Form"],
                            'Fk_articleId'=>$article,
                        ])->id;
                    }
                    if($variety){
                        $variety = get_object_vars($variety)["Pk_varietyId"];
                    }else{
                        $variety = InsertVariety::create([
                            'variety'=>$data[$i]["Variety/Color"],
                        ])->id;
                    }
                }

                $status = DB::table('status')
                    ->select()
                    ->where('status_name', '=', $data[$i]["Status"])->first();
                $brand = DB::table('brands')
                    ->select()
                    ->where('brand_name', '=', $data[$i]["Brand"])->first();
                $manu = DB::table('manufacturers')
                    ->select()
                    ->where('manu_name', '=', $data[$i]["Manufacturer"])->first();
                $country = DB::table('countries')
                    ->select()
                    ->where('country', '=', $data[$i]["Country of Origin"])->first();
                $unit = DB::table('units')
                    ->select()
                    ->where('unit', '=', $data[$i]["Unit"])->first();


                if($status){
                    $status = get_object_vars($status)["Pk_statusId"];
                }else{
                    $status = InsertStatus::create([
                        'status_name'=>$data[$i]["Status"],
                    ])->id;
                }

                if($brand){
                    $brand = get_object_vars($brand)["Pk_brandId"];
                }else{
                    $brand = InsertBrand::create([
                        'brand_name'=>$data[$i]["Brand"],
                    ])->id;
                }
          
                if($manu){
                    $manu = get_object_vars($manu)["Pk_manuId"];
                }else{
                    $manu = InsertManu::create([
                        'manu_name'=>$data[$i]["Manufacturer"],
                    ])->id;
                }

                if($country){
                    $country = get_object_vars($country)["Pk_countryId"];
                }else{
                    $country = InsertCountry::create([
                        'country'=>$data[$i]["Country of Origin"],
                    ])->id;
                }

                if($unit){
                    $unit = get_object_vars($unit)["Pk_unitId"];
                }else{
                    $unit = InsertUnit::create([
                        'unit'=>$data[$i]["Unit"],
                    ])->id;
                }
                $waranty=$data[$i]["Warranty"];
                $AcquisDate=$data[$i]["Acquisition Date"];
                 $item = new InsertItem();
                if($waranty){
                    $item->warranty = $waranty;
                }
                if($AcquisDate){
                    $item->acquisition_date = $AcquisDate;
                }
                if($data[$i]["Cost"]){
                    $item->cost = $data[$i]["Cost"];
                }
                $item->Fk_typeId = $type;
                $item->Fk_statusId = $status;
                $item->Fk_manuId = $manu;
                $item->Fk_unitId = $unit;
                $item->Fk_varietyId = $variety;
                $item->Fk_brandId =$brand;
                $item->Fk_countryId = $country;
                $item->Fk_sourcemodeId = 3;
                $item->Fk_itemCategId = 1;
                $item->item_name = $data[$i]["Article"];
                $item->model = $model;
                $item->details2 = $details;
                $item->other = $other;
                
                
                $item->fundSource = "Donation";
                $item->save();
                // echo`row is imported`. $i +1 ;
                //and make the set for the NEW ITEM and SAVE.

                //if not exisiting !!

                //create new Item
                
                DB::commit();
            }
            }catch (\Throwable $th) {
DB::rollBack();
return $th;
            return response()->json([
                'status' => 500,
                'message' => $th -> getMessage(),
            ]);
        } 
    }
            
}
