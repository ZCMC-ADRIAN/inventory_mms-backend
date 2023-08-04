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
use PhpOffice\PhpWord\TemplateProcessor;

class test extends Controller
{
    public function test()
        {
            // Load the DOCX template
            // $template = new TemplateProcessor(storage_path('../public/PAR.docx'));

            // // Define dynamic data
            // $par_no = '2023-08-0001';

            // $data = Inventory::query()
            // ->selectRaw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", location_name, person_name, Quantity AS "qty", cost * Quantity AS "total", cost, newProperty, acquisition_date, fundCluster, invoice, unit, po_date, ors_num, po_conformed, invoice_rec, iar')
            // ->leftJoin('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
            // ->leftJoin('locat_man', 'inventories.Fk_locatmanId', '=', 'locat_man.Pk_locatmanId')
            // ->leftJoin('location', 'locat_man.Fk_locationId', '=', 'location.Pk_locationId')
            // ->leftJoin('article_relation', 'items.Fk_article_relationId', '=', 'article_relation.Pk_article_relationId')
            // ->leftJoin('types', 'article_relation.Fk_typeId', '=', 'types.Pk_typeId')
            // ->leftJoin('articles', 'article_relation.Fk_articleId', '=', 'articles.Pk_articleId')
            // ->leftJoin('variety', 'items.Fk_varietyId', '=', 'variety.Pk_varietyId')
            // ->leftJoin('units', 'items.Fk_unitId', '=', 'units.Pk_unitId')
            // ->leftJoin('item_relation', 'inventories.Fk_item_relationId', '=', 'item_relation.Pk_item_relationId')
            // ->leftJoin('par_details', 'par_details.Pk_parDetails', '=', 'item_relation.Fk_parDetailsId')
            // ->leftJoin('fundcluster', 'par_details.Fk_fundClusterId', '=', 'fundcluster.Pk_fundClusterId')
            // ->leftJoin('associate', 'locat_man.Fk_assocId', '=', 'associate.Pk_assocId')
            // ->where('par_number', $par_no)
            // ->get();

            // // Duplicate and populate the table rows
            // $template->cloneRow('qty', count($data));
            // foreach ($data as $index => $row) {
            //     $template->setValue('qty#' . ($index + 1), $row['qty']);
            //     $template->setValue('unit#' . ($index + 1), $row['unit']);
            //     $template->setValue('desc#' . ($index + 1), $row['desc']);
            //     $template->setValue('newProperty#' . ($index + 1), $row['newProperty']);
            //     $template->setValue('acquisition_date#' . ($index + 1), $row['acquisition_date']);
            //     $template->setValue('cost#' . ($index + 1), $row['cost']);
            //     $template->setValue('fundCluster#' . ($index), $row['fundCluster']);
            // }
            // $filename = 'PAR';
            // $filePath = storage_path('app/' . $filename . '.docx');
            // $template->saveAs($filePath);
    
            // // Return the generated file for download with the correct MIME type
            // return response()->download($filePath, $filename . '.docx', [
            //     'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            // ])->deleteFileAfterSend();

            $inventoryId = 1;
            if (!empty($inventoryId)) {
                $item = Inventory::where('Pk_inventoryId', $inventoryId)->first();
                $itemId = $item->Fk_itemId;
            }

            return response()->json($itemId);
        }
}