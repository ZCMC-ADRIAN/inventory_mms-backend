<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsertArticle;
use App\Models\InsertVariety;
use App\Models\InsertBrand;
use App\Models\InsertManu;
use App\Models\InsertStatus;
use App\Models\InsertSupplier;
use App\Models\InsertCountry;
use App\Models\InsertUnit;
use App\Models\InsertTypes;
use App\Models\InsertItem;
use Illuminate\Support\Facades\DB;

class InsertDetails extends Controller
{
    public function insert_details(Request $req)
    {
        try {
            $articles = DB::table('articles')->join('types', 'articles.Pk_articleId', '=', 'types.Fk_articleId')->where('article_name', $req->article)->orWhere('type_name', $req->type)->count();
            $varieties = DB::table('variety')->where('variety', $req->variant)->count();

            $article = new InsertArticle();
            $article->article_name = $req->article;
            $article->save();

            $variety = new InsertVariety();
            $variety->variety = $req->variant;
            $variety->save();

            $unit = new InsertUnit();
            $unit->unit = $req->unit;
            $unit->save();

            $brand = new InsertBrand();
            $brand->brand_name = $req->brand;
            $brand->save();

            $country = new InsertCountry();
            $country->country = $req->countries;
            $country->save();

            $manu = new InsertManu();
            $manu->manu_name = $req->manufacturer;
            $manu->save();

            $status = new InsertStatus();
            $status->status_name = $req->status;
            $status->save();

            $supplier = new InsertSupplier();
            $supplier->supplier = $req->supplier;
            $supplier->save();

            $types = new InsertTypes();
            $types->type_name = $req->type;
            $types->Fk_articleId = $article->Pk_articleId;
            $types->save();

            $item = new InsertItem();
            $item->Fk_varietyId = $variety->Pk_varietyId;
            $item->Fk_unitId = $unit->Pk_unitId;
            $item->Fk_brandId = $brand->Pk_brandId;
            $item->Fk_countryId = $country->Pk_countryId;
            $item->Fk_manuId = $manu->Pk_manuId;
            $item->Fk_statusId = $status->Pk_statusId;
            $item->Fk_supplierId = $supplier->Pk_supplierId;
            $item->Fk_typeId = $types->Pk_typeId;
            $item->save();

            return response()->json([
                'status' => 1
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }
}
