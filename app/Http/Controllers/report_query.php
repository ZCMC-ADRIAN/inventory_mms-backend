<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test(Request $request)
    {
        try {
            $data = Inventory::query()
                ->selectRaw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", location_name, person_name, cost AS "costs", Quantity AS "qty", cost * Quantity AS "total", property_no, serial')
                ->leftJoin('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                ->leftJoin('locat_man', 'inventories.Fk_locatmanId', '=', 'locat_man.Pk_locatmanId')
                ->leftJoin('location', 'locat_man.Fk_locationId', '=', 'location.Pk_locationId')
                ->leftJoin('article_relation', 'items.Fk_article_relationId', '=', 'article_relation.Pk_article_relationId')
                ->leftJoin('types', 'article_relation.Fk_typeId', '=', 'types.Pk_typeId')
                ->leftJoin('articles', 'article_relation.Fk_articleId', '=', 'articles.Pk_articleId')
                ->leftJoin('variety', 'items.Fk_varietyId', '=', 'variety.Pk_varietyId')
                ->leftJoin('units', 'items.Fk_unitId', '=', 'units.Pk_unitId')
                ->leftJoin('associate', 'locat_man.Fk_assocId', '=', 'associate.Pk_assocId')
                ->leftJoin('itemcateg', 'items.Fk_itemCategId', '=', 'itemcateg.Pk_itemCategId')
                ->where('cost', '<', 50000)
                ->with([
                    'item.articleRelation.type',
                    'item.variety',
                    'item.unit',
                    'locatMan.location',
                    'locatMan.associate',
                    'item.itemCateg',
                ])
                ->get();

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }
}
