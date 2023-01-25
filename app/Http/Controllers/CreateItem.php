<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

class CreateItem extends Controller
{
    public function CreateItem(Request $req)
    {
        try {
            $articles = DB::table('articles')->where('article_name', $req->article)->count();
            $brand = DB::table('brands')->where('brand_name', $req->brand)->count();
            $country = DB::table('countries')->where('country', $req->countries)->count();
            $unit = DB::table('units')->where('unit', $req->unit)->count();
            $status = DB::table('status')->where('status_name', $req->status)->count();
            $variety = DB::table('variety')->where('variety', $req->variant)->count();
            $supplier = DB::table('suppliers')->where('supplier', $req->supplier)->count();
            $manu = DB::table('manufacturers')->where('manu_name', $req->manufacturer)->count();
            $brandId = null;
            $countryId = null;
            $unitId = null;
            $statusId = null;
            $varietyId = null;
            $supplierId = null;
            $manuId = null;
            $articleId = null;
            $mode = null;

            if ($req->brand != '') {
                if ($brand < 1) {
                    $brand = new InsertBrand();
                    $brand->brand_name = $req->brand;
                    $brand->save();
                    $brandId = $brand->Pk_brandId;
                } else {
                    $resBrand = DB::table('brands')->select('Pk_brandId')->where('brand_name', $req->brand)->get();

                    foreach ($resBrand as $a) {
                        $brandId = $a->Pk_brandId;
                    }
                }
            }

            if ($req->countries != '') {
                if ($country < 1) {
                    $country = new InsertCountry();
                    $country->country = $req->countries;
                    $country->save();

                    $countryId = $country->Pk_countryId;
                } else {
                    $resCountry = DB::table('countries')->select('Pk_countryId')->where('country', $req->countries)->get();

                    foreach ($resCountry as $b) {
                        $countryId = $b->Pk_countryId;
                    }
                }
            }

            if ($req->unit != '') {
                if ($unit < 1) {
                    $unit = new InsertUnit();
                    $unit->unit = $req->unit;
                    $unit->save();
                    $unitId = $unit->Pk_unitId;
                } else {
                    $resUnit = DB::table('units')->select('Pk_unitId')->where('unit', $req->unit)->get();

                    foreach ($resUnit as $c) {
                        $unitId = $c->Pk_unitId;
                    }
                }
            }

            if ($req->status != '') {
                if ($status < 1) {
                    $status = new InsertStatus();
                    $status->status_name = $req->status;
                    $status->save();

                    $statusId = $status->Pk_statusId;
                } else {
                    $resStatus = DB::table('status')->select('Pk_statusId')->where('status_name', $req->status)->get();

                    foreach ($resStatus as $d) {
                        $statusId = $d->Pk_statusId;
                    }
                }
            }

            if ($req->variant != '') {
                if ($variety < 1) {
                    $variety = new InsertVariety();
                    $variety->variety = $req->variant;
                    $variety->save();
                    $varietyId = $variety->Pk_varietyId;
                } else {
                    $resVariety = DB::table('variety')->select('Pk_varietyId')->where('variety', $req->variant)->get();

                    foreach ($resVariety as $e) {
                        $varietyId = $e->Pk_varietyId;
                    }
                }
            }

            if ($req->supplier != '') {
                if($req->acquisitionMode === 'Purchase'){
                    $mode = 0;
                }else if($req->acquisitionMode === 'Donation'){
                    $mode = 1;
                }
                if ($supplier < 1) {
                    $supplier = new InsertSupplier();
                    $supplier->supplier = $req->supplier;
                    $supplier->mode = $mode;
                    $supplier->save();
                    $supplierId = $supplier->Pk_supplierId;
                } else {
                    $resSupplier = DB::table('suppliers')->select('Pk_supplierId')->where('supplier', $req->supplier)->get();

                    foreach ($resSupplier as $f) {
                        $supplierId = $f->Pk_supplierId;
                    }
                }
            }

            if ($req->manufacturer != '') {
                if ($manu < 1) {
                    $manu = new InsertManu();
                    $manu->manu_name = $req->manufacturer;
                    $manu->save();
                    $manuId = $manu->Pk_manuId;
                } else {
                    $resManu = DB::table('manufacturers')->select('Pk_manuId')->where('manu_name', $req->manufacturer)->get();

                    foreach ($resManu as $g) {
                        $manuId = $g->Pk_manuId;
                    }
                }
            }

            if ($req->article != '') {
                if ($articles < 1) {
                    $article = new InsertArticle();
                    $article->article_name = $req->article;
                    $article->save();
                    $articleId = $article->Pk_articleId;
                }else{
                    $resArticle = DB::table('articles')->select('Pk_articleId')->where('article_name', $req->article)->get();

                    foreach ($resArticle as $h) {
                        $articleId = $h->Pk_articleId;
                    }
                }
            }

            $types = new InsertTypes();
            $types->type_name = $req->type;
            $types->Fk_articleId = $articleId;
            $types->save();

            $item = new InsertItem();
            $item->Fk_typeId = $types->Pk_typeId;
            $item->Fk_statusId = $statusId;
            $item->Fk_manuId = $manuId;
            $item->Fk_supplierId = $supplierId;
            $item->Fk_unitId = $unitId;
            $item->Fk_varietyId = $varietyId;
            $item->Fk_brandId = $brandId;
            $item->Fk_countryId = $countryId;
            $item->item_name = $req->descOrig;
            $item->model = $req->model;
            $item->details2 = $req->details;
            $item->other = $req->other;
            $item->serial = $req->serial;
            $item->warranty = $req->warranty;
            $item->acquisition_date = $req->acquisition;
            $item->property_no = $req->propertyNum;
            $item->expiration = $req->expiration;
            $item->fundSource = $req->acquisitionMode;
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
