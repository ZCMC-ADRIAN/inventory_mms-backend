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

            // Update Acquisition Date, Warranty, and other fields similarly

            // Update Article and Type
            if (!empty($req->article) && !empty($req->type)) {
                $article = InsertArticle::firstOrCreate(['article_name' => $req->article]);
                $type = InsertTypes::firstOrCreate(['type_name' => $req->type]);
                $articleRelation = ArticleRelation::firstOrCreate(['Fk_articleId' => $article->Pk_articleId, 'Fk_typeId' => $type->Pk_typeId]);
                $item->Fk_article_relationId = $articleRelation->Pk_article_relationId;
            }

            // Update Brand, Variety, Manufacturer, and Country
            // Implement similarly as done for Supplier and Unit above

            // Update Unit
            if ($req->brand != '') {
                $brand = InsertBrand::firstOrCreate(['brands' => $req->brand]);
                $item->brandId = $unit->Pk_brandId;
            }

            if ($req->variant != '') {
                $variety = InsertVariety::firstOrCreate(['variety' => $req->variety]);
                $item->varietyId = $variety->Pk_varietyId;
            }

            if ($req->manufacturer != '') {
                $manufacturer = InsertManu::firstOrCreate(['manufacturer' => $req->manufacturer]);
                $item->manufacturerId = $manufacturer->Pk_manufacturerId;
            }

            if ($req->countries != '') {
                $manufacturer = InsertCountry::firstOrCreate(['countries' => $req->countries]);
                $item->countriesId = $countries->Pk_countryId;
            }

            // Save the updated item
            $item->save();

            return response()->json([
                "status" => 1
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage()
            ], 500);
        }
    }
}
