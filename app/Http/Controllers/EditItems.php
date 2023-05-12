<?php

namespace App\Http\Controllers;

use App\Models\InsertBrand;
use App\Models\InsertArticle;
use App\Models\InsertTypes;
use App\Models\InsertVariety;
use App\Models\InsertCountry;
use App\Models\InsertManu;
use App\Models\InsertSupplier;
use App\Models\InsertUnit;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditItems extends Controller
{
    public function editItem(Request $req)
    {
        try {
            $resType = DB::table('items')->select('Fk_typeId')->where('Pk_itemId', $req->itemId)->get();
            $resTypeId = DB::table('types')->select('Pk_typeId')->where('type_name', $req->type)->get();
            $brand = DB::table('brands')->where('brand_name', $req->brand)->count();
            $articles = DB::table('articles')->where('article_name', $req->article)->count();
            $category = DB::table('itemcateg')->where('itemCateg_name', $req->category)->count();
            $variety = DB::table('variety')->where('variety', $req->variant)->count();
            $manu = DB::table('manufacturers')->where('manu_name', $req->manufacturer)->count();
            $country = DB::table('countries')->where('country', $req->countries)->count();
            $unit = DB::table('units')->where('unit', $req->unit)->count();
            $supplier = DB::table('suppliers')->where('supplier', $req->supplier)->count();

            //Update Remarks
            if ($req->remarks) {
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['remarks' => $req->remarks]);
            }

            //Update Expiration
            if ($req->expiration) {
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['expiration' => $req->expiration]);
            }

            //Update Cost
            if ($req->cost != '') {
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['cost' => $req->cost]);
            }

            //Update Supplier
            if ($req->supplier != '') {
                if ($req->acquiMode === 'Purchase') {
                    $mode = 0;
                } else if ($req->acquiMode === 'Donation') {
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
                    $supplierId = null;

                    foreach ($resSupplier as $f) {
                        $supplierId = $f->Pk_supplierId;
                    }
                }
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['Fk_supplierId' => $supplierId]);
            }

            //Update Acquisition Mode
            if ($req->acquiMode != '') {
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['fundSource' => $req->acquiMode]);
            }

            //Udpate Unit
            if ($req->unit != '') {
                if ($unit < 1) {
                    $unit = new InsertUnit();
                    $unit->unit = $req->unit;
                    $unit->save();
                    $unitId = $unit->Pk_unitId;
                } else {
                    $resUnit = DB::table('units')->select('Pk_unitId')->where('unit', $req->unit)->get();
                    $unitId = null;

                    foreach ($resUnit as $c) {
                        $unitId = $c->Pk_unitId;
                    }
                }
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['Fk_unitId' => $unitId]);
            }

            //Update Acquisition Date
            if ($req->acquisition != '') {
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['acquisition_date' => $req->acquisition]);
            }

            //Update Warranty
            if ($req->warranty != '') {
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['warranty' => $req->warranty]);
            }

            //Update Country
            if ($req->countries != '') {
                if ($country < 1) {
                    $country = new InsertCountry();
                    $country->country = $req->countries;
                    $country->save();

                    $countryId = $country->Pk_countryId;
                } else {
                    $resCountry = DB::table('countries')->select('Pk_countryId')->where('country', $req->countries)->get();
                    $countryId = null;

                    foreach ($resCountry as $b) {
                        $countryId = $b->Pk_countryId;
                    }
                }
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['Fk_countryId' => $countryId]);
            }

            //Update Manufacturer
            if ($req->manufacturer != '') {
                if ($manu < 1) {
                    $manu = new InsertManu();
                    $manu->manu_name = $req->manufacturer;
                    $manu->save();
                    $manuId = $manu->Pk_manuId;
                } else {
                    $resManu = DB::table('manufacturers')->select('Pk_manuId')->where('manu_name', $req->manufacturer)->get();
                    $manuId = null;

                    foreach ($resManu as $g) {
                        $manuId = $g->Pk_manuId;
                    }
                }
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['Fk_manuId' => $manuId]);
            }

            //Update brand
            if ($req->brand != '') {
                if ($brand < 1) {
                    $brand = new InsertBrand();
                    $brand->brand_name = $req->brand;
                    $brand->save();
                    $brandId = $brand->Pk_brandId;
                } else {
                    $resBrand = DB::table('brands')->select('Pk_brandId')->where('brand_name', $req->brand)->get();
                    $brandId = null;

                    foreach ($resBrand as $a) {
                        $brandId = $a->Pk_brandId;
                    }
                }
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['Fk_brandId' => $brandId]);
            }

            //Update Other
            if ($req->other != '') {
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['other' => $req->other]);
            }

            //Update Accessories
            if ($req->accessories != '') {
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['accessories' => $req->accessories]);
            }

            //Update Details
            if ($req->details != '') {
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['details2' => $req->details]);
            }

            //Update Variety
            if ($req->variant != '') {
                if ($variety < 1) {
                    $variety = new InsertVariety();
                    $variety->variety = $req->variant;
                    $variety->save();
                    $varietyId = $variety->Pk_varietyId;
                } else {
                    $resVariety = DB::table('variety')->select('Pk_varietyId')->where('variety', $req->variant)->get();
                    $varietyId = null;

                    foreach ($resVariety as $var) {
                        $varietyId = $var->Pk_varietyId;
                    }
                }

                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['Fk_varietyId' => $varietyId]);
            }

            //Update Model
            if ($req->model != '') {
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['model' => $req->model]);
            }

            foreach ($resType as $i) {
                $curTypeId = $i->Fk_typeId;
            }

            foreach ($resTypeId as $j) {
                $selTypeId = $j->Pk_typeId;
            }

            //Update Article
            if ($req->article != '') {
                if ($articles < 1) {
                    $article = new InsertArticle();
                    $article->article_name = $req->article;
                    $article->save();
                    $articleId = $article->Pk_articleId;
                } else {
                    $resArticle = DB::table('articles')->select('Pk_articleId')->where('article_name', $req->article)->get();
                    $articleId = null;

                    foreach ($resArticle as $h) {
                        $articleId = $h->Pk_articleId;
                    }
                }
            }

            //Update Type
            if ($req->otherType === 'Other') {
                $types = new InsertTypes();
                $types->type_name = $req->type;
                $types->Fk_articleId = $articleId;
                $types->save();

                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['Fk_typeId' => $types->Pk_typeId]);
            } else if ($curTypeId != $selTypeId) {
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['Fk_typeId' => $selTypeId]);
            }

            //Update category
            if ($req->category != '') {
                if ($category > 0) {
                    $resCateg = DB::table('itemcateg')->select('Pk_itemCategId')->where('itemCateg_name', $req->category)->get();
                    $categId = null;

                    foreach ($resCateg as $cat) {
                        $categId = $cat->Pk_itemCategId;
                    }
                }
                DB::table('items')->where('Pk_itemId', $req->itemId)->update(['Fk_itemCategId' => $categId]);
            }

            return response()->json([
                "status" => 1
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ]);
        }
    }
}
