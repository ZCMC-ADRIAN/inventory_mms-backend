<?php
////AKEL OBJECT MUST PASS IN AN ARRAY DAW
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

                    //trim
                    // if(trim($row[2]," ") == trim('Table               '," ")){
                        
                    //     $table[] = array_combine($header,$row);
                    // }
                }
            }

            fclose($handle);
           for ($i = 0; $i < count($data); $i ++)
            {
                
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
                    ",[$data[$i]["Item Description"]]);
                    // ->having('item_name', '=', $data[$i]["Item Description"])->first();
                
                if($dataa){
                    // if($i+2 == 34){
                    //     dd($dataa);
                    // }
                    dd($dataa);
                    $isArticleId = null;
                    $article = DB::table('articles')
                    ->select()
                    ->where('article_name', '=', $data[$i]["Article"]?$data[$i]["Article"]:null)->first();
                    
                    if(!$article){
                        $article =  new InsertArticle();
                        $article->article_name = $data[$i]["Article"]?$data[$i]["Article"]:null;
                        $article->save();
                        $isArticleId = $article->Pk_articleId;
                    }
                   $trying = $article;
                    
                    $variety= get_object_vars($dataa)["Fk_varietyId"];
                    $model=get_object_vars($dataa)["model"];
                    $details=get_object_vars($dataa)["details2"];
                    $other=get_object_vars($dataa)["other"];

                    if($isArticleId){
                        $hasArticle =$article? DB::table('types')
                    ->where('type_name', $data[$i]["Type/Form"]?$data[$i]["Type/Form"]:null)
                    ->where('Fk_articleId', $isArticleId)
                    ->first():false;

                        $hasArticle =$article? DB::table('types')
                    ->where('type_name', $data[$i]["Type/Form"]?$data[$i]["Type/Form"]:null)
                    ->where('Fk_articleId', $isArticleId)
                    ->first():false;
                    }else{
                        $hasArticle =$article? DB::table('types')
                    ->where('type_name', $data[$i]["Type/Form"]?$data[$i]["Type/Form"]:null)
                    ->where('Fk_articleId', get_object_vars($article)["Pk_articleId"]?get_object_vars($article)["Pk_articleId"]:null)
                    ->first():false;

                        $hasArticle =$article? DB::table('types')
                    ->where('type_name', $data[$i]["Type/Form"]?$data[$i]["Type/Form"]:null)
                    ->where('Fk_articleId', get_object_vars($article)["Pk_articleId"]?get_object_vars($article)["Pk_articleId"]:null)
                    ->first():false;
                    }
                    
                    if($hasArticle){
                        $type = get_object_vars($hasArticle)["Pk_typeId"];
                    }else{
                        if($isArticleId){$type = new InsertTypes();
                        $type->type_name=$data[$i]["Type/Form"]?$data[$i]["Type/Form"]:null;
                        $type->Fk_articleId=$isArticleId;
                        $type->save();
                        $type=$type->Pk_typeId;}else{$type = new InsertTypes();
                        $type->type_name=$data[$i]["Type/Form"]?$data[$i]["Type/Form"]:null;
                        $type->Fk_articleId=get_object_vars($article)["Pk_articleId"];
                        $type->save();
                        $type=$type->Pk_typeId;}
                        

                    }
                }
                else{

                    $article = DB::table('articles')
                    ->select()
                    ->where('article_name', '=', $data[$i]["Article"]?$data[$i]["Article"]:null)->first();
                    
                    $type = DB::table('types')
                    ->select()
                    ->where('type_name', '=', $data[$i]["Type/Form"]?$data[$i]["Type/Form"]:null)->first();
                    $variety = DB::table('variety')
                    ->select()
                    ->where('variety', '=', $data[$i]["Variety/Color"])->first();
                    //->if the article existing get the id;
                    
                    // get_object_vars($dataa)["Fk_statusId"];
                    $hasArticle =$article? DB::table('types')
                    ->where('type_name', $data[$i]["Type/Form"]?$data[$i]["Type/Form"]:null)
                    ->where('Fk_articleId', get_object_vars($article)["Pk_articleId"]?get_object_vars($article)["Pk_articleId"]:null)
                    ->first():false;
                    //dd($hasArticle);

                    if($article){
                        $article = get_object_vars($article)["Pk_articleId"];
                        // echo 'existing saved'. $article;
                    }else{
                        
                        $article = new InsertArticle();
                        $article->article_name = $data[$i]["Article"]?$data[$i]["Article"]:null;
                        $article->save();
                        $article = $article->Pk_articleId;
                        // $article = InsertArticle::create([
                        //     'article_name'=>$data[$i]["Article"],
                        // ]);
                        // dd($article);
                    }
                    if($hasArticle){
                        $type = get_object_vars($hasArticle)["Pk_typeId"];
                    }else{
                        $type = new InsertTypes();
                        $type->type_name=$data[$i]["Type/Form"]?$data[$i]["Type/Form"]:null;
                        $type->Fk_articleId=$article;
                        $type->save();
                        $type=$type->Pk_typeId;
                    }
                    if($variety){
                        $variety = get_object_vars($variety)["Pk_varietyId"];
                    }else{
                        $variety = new InsertVariety();
                        $variety->variety = $data[$i]["Variety/Color"];
                        $variety->save();
                        $variety = $variety->Pk_varietyId;
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
                    $status = new InsertStatus();
                    $status->status_name=$data[$i]["Status"];
                    $status->save();
                    $status= $status->Pk_statusId;
                }

                if($brand){
                    $brand = get_object_vars($brand)["Pk_brandId"];
                }else{
                    $brand =new InsertBrand();
                    $brand->brand_name=$data[$i]["Brand"];
                    $brand->save();
                    $brand=$brand->Pk_brandId;
                }
          
                if($manu){
                    $manu = get_object_vars($manu)["Pk_manuId"];
                }else{
                    $manu =new InsertManu();
                    $manu->manu_name=$data[$i]["Manufacturer"];
                    $manu->save();
                    $manu=$manu->Pk_manuId;
                    
                }

                if($country){
                    $country = get_object_vars($country)["Pk_countryId"];
                }else{
                    $country = new InsertCountry();
                    $country->country=$data[$i]["Country of Origin"];
                    $country->save();
                    $country=$country->Pk_countryId;
                    
                }

                if($unit){
                    $unit = get_object_vars($unit)["Pk_unitId"];
                }else{
                    $unit =new InsertUnit();
                    $unit->unit=$data[$i]["Unit"];
                    $unit->save();
                    $unit = $unit->Pk_unitId;
                    
                }
                $waranty=$data[$i]["Warranty"]?$data[$i]["Warranty"]:null;
                $AcquisDate=$data[$i]["Acquisition Date"]?$data[$i]["Acquisition Date"]:null;
                $item = new InsertItem();
                if($waranty){
                    $item->warranty = $waranty;
                }
                if($AcquisDate){
                    $item->acquisition_date = $AcquisDate;
                }
                if($data[$i]["Cost"]){
                    $item->cost = $data[$i]["Cost"]?$data[$i]["Cost"]:null;
                }
                 $itemCheck = DB::table('items')
                ->where('Fk_typeId', $type)
                ->where('Fk_statusId', $status?$status:null)
                ->where('Fk_manuId', $manu?$manu:null)
                ->where('Fk_unitId', $unit?$unit:null)
                ->where('Fk_varietyId', $variety?$variety:null)
                ->where('Fk_brandId', $brand?$brand:null)
                ->where('Fk_countryId', $country?$country:null)
                ->where('Fk_itemCategId', 1)
                ->where('model', $model?$model:null)
                ->where('details2', $details?$details:null)
                ->where('other', $other?$other:null)
                ->where('warranty', $waranty?$waranty:null)
                ->where('acquisition_date', $AcquisDate?$AcquisDate:null)
                ->where('cost',$data[$i]["Cost"]?intval($data[$i]["Cost"]):0)
                ->exists();
                //echo "item is true: ".$itemCheck.$i+1 ;
                //dd($itemCheck);
                // dd(intval("230.00")==230);
                // if($i+2==11){
                //     dd($hasArticle);
                // }
                if($hasArticle&&$itemCheck){
                    echo 'item table is already exist '.$i+2;
                }else{
                     
                    $item->Fk_typeId = $type;
                    $item->Fk_statusId = $status;
                    $item->Fk_manuId = $manu;
                    $item->Fk_unitId = $unit;
                    $item->Fk_varietyId = $variety;
                    $item->Fk_brandId =$brand;
                    $item->Fk_countryId = $country;
                    $item->Fk_sourcemodeId = 3;
                    $item->Fk_itemCategId = 1;
                    $item->item_name = $data[$i]["Article"]?$data[$i]["Article"]:null;
                    $item->model = $data[$i]["Model"]?$data[$i]["Model"]:null;
                    $item->details2 = $data[$i]["Details2"]?$data[$i]["Details2"]:null;
                    $item->other = $data[$i]["Other"]?$data[$i]["Other"]:null;
                    $item->fundSource = "Donation";
                    $item->save();
                }
                
                // echo`row is imported`. $i +1 ;
                //and make the set for the NEW ITEM and SAVE.

                //if not exisiting !!

                //create new Item
                
                DB::commit();
            }
            DB::rollBack();
            }catch (\Throwable $th) {
            DB::rollBack();
//dd($variety);dd($trying);
 dd($dataa);
return $th;
            return response()->json([
                
                'status' => 500,
                'message' => $th -> getMessage(),
            ]);
        } 
    }
            
}
