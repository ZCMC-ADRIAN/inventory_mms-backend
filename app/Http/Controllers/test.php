<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InsertArticle;
use App\Models\InsertTypes;
use App\Models\PO;
use App\Models\InsertItemRelation;
use App\Models\InsertFundCluster;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $request)
    {
        try {
            $par_no = '2023-08-0001';

            $data = Inventory::query()
            ->selectRaw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", location_name, person_name, Quantity AS "qty", cost * Quantity AS "total", newProperty, acquisition_date, fundCluster, invoice, po_date, ors_num, po_conformed, invoice_rec, iar')
            ->leftJoin('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
            ->leftJoin('locat_man', 'inventories.Fk_locatmanId', '=', 'locat_man.Pk_locatmanId')
            ->leftJoin('location', 'locat_man.Fk_locationId', '=', 'location.Pk_locationId')
            ->leftJoin('article_relation', 'items.Fk_article_relationId', '=', 'article_relation.Pk_article_relationId')
            ->leftJoin('types', 'article_relation.Fk_typeId', '=', 'types.Pk_typeId')
            ->leftJoin('articles', 'article_relation.Fk_articleId', '=', 'articles.Pk_articleId')
            ->leftJoin('variety', 'items.Fk_varietyId', '=', 'variety.Pk_varietyId')
            ->leftJoin('units', 'items.Fk_unitId', '=', 'units.Pk_unitId')
            ->leftJoin('fundcluster', 'items.Fk_fundClusterId', '=', 'fundcluster.Pk_fundClusterId')
            ->leftJoin('item_relation', 'inventories.Fk_item_relationId', '=', 'item_relation.Pk_item_relationId')
            ->leftJoin('par_details', 'par_details.Pk_parDetails', '=', 'item_relation.Fk_parDetailsId')
            ->leftJoin('associate', 'locat_man.Fk_assocId', '=', 'associate.Pk_assocId')
            ->where('par_number', $par_no)
            ->get();
        
        return response()->json($data);                      
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }
}
