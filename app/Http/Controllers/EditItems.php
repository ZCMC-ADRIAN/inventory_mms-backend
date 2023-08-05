<?php

namespace App\Http\Controllers;

use App\Models\InsertItem;
use App\Models\InsertBrand;
use App\Models\InsertArticle;
use App\Models\InsertTypes;
use App\Models\InsertVariety;
use App\Models\InsertManu;
use App\Models\InsertCountry;
use App\Models\InsertUnit;
use App\Models\InsertSupplier;
use App\Models\ArticleRelation;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditItems extends Controller
{
    public function editItem(Request $req)
    {
        try {
            $item = InsertItem::find($req->itemId);

            if (!$item) {
                return response()->json([
                    "message" => "Item not found"
                ], 404);
            }

            // Update Remarks, Expiration, and Cost
            if ($req->remarks) {
                $item->remarks = $req->remarks;
            }

            if ($req->expiration) {
                $item->expiration = $req->expiration;
            }

            if ($req->cost != '') {
                $item->cost = $req->cost;
            }

            // Update Supplier
            if ($req->supplier != '') {
                $mode = ($req->acquiMode === 'Purchase') ? 0 : 1;
                $supplier = InsertSupplier::firstOrCreate(['supplier' => $req->supplier], ['mode' => $mode]);
                $item->Fk_supplierId = $supplier->Pk_supplierId;
            }

            // Update Acquisition Mode
            if ($req->acquiMode != '') {
                $item->fundSource = $req->acquiMode;
            }

            // Update Unit
            if ($req->unit != '') {
                $unit = InsertUnit::firstOrCreate(['unit' => $req->unit]);
                $item->Fk_unitId = $unit->Pk_unitId;
            }

            // Update Article and Type
            if (!empty($req->article) && !empty($req->type)) {
                // Fetch the Article and Type models
                $article = InsertArticle::where('article_name', $req->article)->first();
                $type = InsertTypes::where('type_name', $req->type)->first();
    
                if (!$article) {
                    // If the Article doesn't exist, create a new one
                    $article = new InsertArticle(['article_name' => $req->article]);
                    $article->save();
                }
    
                if (!$type) {
                    // If the Type doesn't exist, create a new one
                    $type = new InsertTypes(['type_name' => $req->type]);
                    $type->save();
                }
    
                // Check if the ArticleRelation already exists for the given Article and Type
                $articleRelation = ArticleRelation::where('Fk_articleId', $article->Pk_articleId)
                                                ->where('Fk_typeId', $type->Pk_typeId)
                                                ->first();
    
                if (!$articleRelation) {
                    // If the ArticleRelation doesn't exist, create a new one
                    $articleRelation = new ArticleRelation();
                    $articleRelation->Fk_articleId = $article->Pk_articleId;
                    $articleRelation->Fk_typeId = $type->Pk_typeId;
                    $articleRelation->save();
    
                    // Fetch the ArticleRelation again to get the correct Pk_article_relationId
                    $articleRelation = ArticleRelation::where('Fk_articleId', $article->Pk_articleId)
                                                    ->where('Fk_typeId', $type->Pk_typeId)
                                                    ->first();
                }
    
                // Update the item with the ArticleRelation ID
                $item->Fk_article_relationId = $articleRelation->Pk_article_relationId;
            }

            // Update Brand, Variety, Manufacturer, and Country
            if ($req->brand != '') {
                $brand = InsertBrand::firstOrCreate(['brand_name' => $req->brand]);
                $item->Fk_brandId = $brand->Pk_brandId;
            }

            if ($req->variant != '') {
                $variety = InsertVariety::firstOrCreate(['variety' => $req->variant]);
                $item->Fk_varietyId = $variety->Pk_varietyId;
            }

            if ($req->manufacturer != '') {
                $manufacturer = InsertManu::firstOrCreate(['manu_name' => $req->manufacturer]);
                $item->Fk_manuId = $manufacturer->Pk_manuId;
            }

            if ($req->countries != '') {
                $countries = InsertCountry::firstOrCreate(['country' => $req->countries]);
                $item->Fk_countryId = $countries->Pk_countryId;
            }

            // Save the updated item
            $item->save();

            return response()->json([
                "status" => 1,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage()
            ], 500);
        }
    }
}