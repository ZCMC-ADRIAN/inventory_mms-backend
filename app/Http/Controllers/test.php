<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InsertArticle;
use App\Models\InsertTypes;
use App\Models\PO;
use App\Models\InsertItemRelation;
use App\Models\InsertFundCluster;
use App\Models\ItemAttributes;
use App\Models\InventoryItemRelation;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

class test extends Controller
{
    public function test()
        {
            try {

                $template = new TemplateProcessor(storage_path('../public/ICS.docx'));

                // Define dynamic data
                $ics_no = 'D2023-08-0001';
                $par_no = 'D2023-08-0001';
    
                // $data = Inventory::query()
                // ->selectRaw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", location_name, person_name, Quantity AS "qty", cost * Quantity AS "total", cost, newProperty, acquisition_date, fundCluster, invoice, unit, po_date, ors_num, po_conformed, invoice_rec, iar, po_number, drf_num, ptr_num, drf_date')
                // ->leftJoin('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                // ->leftJoin('locat_man', 'inventories.Fk_locatmanId', '=', 'locat_man.Pk_locatmanId')
                // ->leftJoin('location', 'locat_man.Fk_locationId', '=', 'location.Pk_locationId')
                // ->leftJoin('article_relation', 'items.Fk_article_relationId', '=', 'article_relation.Pk_article_relationId')
                // ->leftJoin('types', 'article_relation.Fk_typeId', '=', 'types.Pk_typeId')
                // ->leftJoin('articles', 'article_relation.Fk_articleId', '=', 'articles.Pk_articleId')
                // ->leftJoin('variety', 'items.Fk_varietyId', '=', 'variety.Pk_varietyId')
                // ->leftJoin('units', 'items.Fk_unitId', '=', 'units.Pk_unitId')
                // ->leftJoin('item_attributes', 'inventories.Fk_item_attributes', 'item_attributes.id')
                // ->leftJoin('ics', 'item_attributes.Fk_ics_ID', '=', 'ics.id')
                // ->leftJoin('regular_series', 'item_attributes.Fk_regular_series', '=', 'regular_series.id')
                // ->leftJoin('regular', 'regular_series.Fk_regular_ID', '=', 'regular.id')
                // ->leftJoin('fundCluster', 'regular.Fk_fundClusterId', 'fundCluster.Pk_fundClusterId')
                // ->leftJoin('associate', 'locat_man.Fk_assocId', '=', 'associate.Pk_assocId')
                // ->leftJoin('po_number', 'item_attributes.Fk_po_ID', '=', 'po_number.Pk_poId')
                // ->leftJoin('donation_series', 'item_attributes.Fk_donation_series', '=', 'donation_series.id')
                // ->leftJoin('donation', 'donation_series.Fk_donation_ID', '=', 'donation.id')
                // ->where('ics_number', $ics_no)
                // ->get();

                $data = Inventory::query()
                ->selectRaw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", location_name, person_name, Quantity AS "qty", cost * Quantity AS "total", cost, newProperty, acquisition_date, fundCluster, invoice, unit, po_date, ors_num, po_conformed, invoice_rec, iar, po_number, drf_num, ptr_num, drf_date, fundSource')
                ->leftJoin('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                ->leftJoin('locat_man', 'inventories.Fk_locatmanId', '=', 'locat_man.Pk_locatmanId')
                ->leftJoin('location', 'locat_man.Fk_locationId', '=', 'location.Pk_locationId')
                ->leftJoin('article_relation', 'items.Fk_article_relationId', '=', 'article_relation.Pk_article_relationId')
                ->leftJoin('types', 'article_relation.Fk_typeId', '=', 'types.Pk_typeId')
                ->leftJoin('articles', 'article_relation.Fk_articleId', '=', 'articles.Pk_articleId')
                ->leftJoin('variety', 'items.Fk_varietyId', '=', 'variety.Pk_varietyId')
                ->leftJoin('units', 'items.Fk_unitId', '=', 'units.Pk_unitId')
                ->leftJoin('item_attributes', 'inventories.Fk_item_attributes', 'item_attributes.id')
                ->leftJoin('par', 'item_attributes.Fk_par_ID', '=', 'par.id')
                ->leftJoin('regular_series', 'item_attributes.Fk_regular_series', '=', 'regular_series.id')
                ->leftJoin('regular', 'regular_series.Fk_regular_ID', '=', 'regular.id')
                ->leftJoin('fundCluster', 'regular.Fk_fundClusterId', 'fundCluster.Pk_fundClusterId')
                ->leftJoin('associate', 'locat_man.Fk_assocId', '=', 'associate.Pk_assocId')
                ->leftJoin('po_number', 'item_attributes.Fk_po_ID', '=', 'po_number.Pk_poId')
                ->leftJoin('donation_series', 'item_attributes.Fk_donation_series', '=', 'donation_series.id')
                ->leftJoin('donation', 'donation_series.Fk_donation_ID', '=', 'donation.id')
                ->where('par_number', $par_no)
                ->get();
    
                // Duplicate and populate the table rows
                // $template->cloneRow('qty', count($data));
                // foreach ($data as $index => $row) {
                //     $template->setValue('qty#' . ($index + 1), $row['qty']);
                //     $template->setValue('unit#' . ($index + 1), $row['unit']);
                //     $template->setValue('desc#' . ($index + 1), $row['desc']);
                //     $template->setValue('newProperty#' . ($index + 1), $row['newProperty']);
                //     $template->setValue('acquisition_date#' . ($index + 1), $row['acquisition_date']);
                //     $template->setValue('cost#' . ($index + 1), $row['cost']);
                //     $template->setValue('fundCluster' , $row['fundCluster']);
                //     $template->setValue('person_name' , $row['person_name']); 
                //     $template->setValue('par' , $par_no);   
                // }

                // $filename = 'PAR';
                // $filePath = storage_path('app/' . $filename . '.docx');
                // $template->saveAs($filePath);
                
                // return response()->download($filePath, $filename . '.docx', [
                //     'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                // ])->deleteFileAfterSend();

                return response()->json($data);
                // $itemId = 1;
                // $assoc_id = 5;

                // $cost = DB::table('items')
                // ->where('Pk_itemId', $itemId)
                // ->value('cost');
            
                // $joinTable = $cost >= 50000 ? 'par' : 'ics';
            
                // $checkingPO = DB::table('inventories')
                // ->select('Fk_person_ID', 'Pk_poId', 'regular_series.id AS series_id')
                // ->leftJoin('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                // ->leftJoin('item_attributes', 'inventories.Fk_item_attributes', '=', 'item_attributes.id')
                // ->leftJoin('regular_series', 'item_attributes.Fk_regular_series', '=', 'regular_series.id')
                // ->leftJoin($joinTable, 'item_attributes.Fk_' . $joinTable . '_ID', '=', $joinTable . '.id')
                // ->leftJoin('po_number', 'item_attributes.Fk_po_ID', '=', 'po_number.Pk_poId')
                // ->where('Fk_itemId', $itemId)
                // ->get();

                // $assocIdInCheckingPO = false;
    
                // foreach ($checkingPO as $entry) {
                //     if ($entry->Fk_person_ID == $assoc_id) {
                //         $assocIdInCheckingPO = true;
                //         break;
                //     }
                // }

                // $regularId = $entry->series_id;
                // $poId = $entry->Pk_poId;

                // $getAttributes = DB::table('item_attributes') 
                // ->select('item_attributes.id')
                // ->leftJoin('po_number', 'item_attributes.Fk_po_ID', '=', 'po_number.Pk_poId')
                // ->leftJoin($joinTable, 'item_attributes.Fk_' . $joinTable . '_ID', '=', $joinTable . '.id')
                // ->leftJoin('associate', 'Pk_assocId', '=',  "$joinTable.Fk_person_ID")
                // ->where('Pk_poId', $poId)
                // ->where('Fk_person_ID', $assoc_id)
                // ->value('item_attributes.id');
            
                return response()->json($regularId);            

            } catch (\Throwable $th) {
                return response()->json([
                    'message' => $th -> getMessage()
                ]);
            }
        }
}