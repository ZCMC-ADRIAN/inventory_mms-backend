<?php

namespace App\Http\Controllers;
use PhpOffice\PhpWord\TemplateProcessor;

use Illuminate\Http\Request;
use App\Models\Inventory;

class GeneratePAR extends Controller
{
    public function generatePAR(Request $req){
        try {
            // $template = new TemplateProcessor(storage_path('../public/PAR.docx'));
            // $donation = new TemplateProcessor(storage_path('../public/PAR - Donation.docx'));
            
            $par_no = $req->par;

            $data = Inventory::query()
            ->selectRaw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", location_name, person_name, Quantity AS "qty", cost * Quantity AS "total", FORMAT(cost, 2) AS "costs", newProperty, acquisition_date, fundCluster, invoice, unit, po_date, ors_num, po_conformed, invoice_rec, iar, po_number, drf_num, ptr_num, drf_date, fundSource')
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
            ->whereNotNull('par_number')
            ->get();

            return response()->json($data);

            // Duplicate and populate the table rows
            // $template->cloneRow('qty', count($data));
            // $donation->cloneRow('qty', count($data));
            // foreach ($data as $index => $row) {
            //     if($row['fundSource'] === 'Donation'){
            //         $donation->setValue('qty#' . ($index + 1), $row['qty']);
            //         $donation->setValue('unit#' . ($index + 1), $row['unit']);
            //         $donation->setValue('desc#' . ($index + 1), $row['desc']);
            //         $donation->setValue('newProperty#' . ($index + 1), $row['newProperty']);
            //         $donation->setValue('acquisition_date#' . ($index + 1), $row['acquisition_date']);
            //         $donation->setValue('cost#' . ($index + 1), $row['cost']);
            //         $donation->setValue('fundCluster' , $row['fundCluster']);
            //         $donation->setValue('person_name' , strtoupper($row['person_name'])); 
            //         $donation->setValue('par' , $par_no);   
            //         $donation->setValue('drf', $row['drf_num']);
            //         $donation->setValue('ptr', $row['ptr_num']);
            //         $donation->setValue('drf_date', $row['drf_date']);
            //     }else{
            //         $template->setValue('qty#' . ($index + 1), $row['qty']);
            //         $template->setValue('unit#' . ($index + 1), $row['unit']);
            //         $template->setValue('desc#' . ($index + 1), $row['desc']);
            //         $template->setValue('newProperty#' . ($index + 1), $row['newProperty']);
            //         $template->setValue('acquisition_date#' . ($index + 1), $row['acquisition_date']);
            //         $template->setValue('cost#' . ($index + 1), $row['cost']);
            //         $template->setValue('fundCluster' , $row['fundCluster']);
            //         $template->setValue('person_name' , strtoupper($row['person_name'])); 
            //         $template->setValue('par' , $par_no);   
            //         $template->setValue('invoice', $row['invoice']);
            //         $template->setValue('po_number', $row['po_number']);
            //         $template->setValue('ors_num', $row['ors_num']);
            //         $template->setValue('po_conformed', $row['po_conformed']);
            //         $template->setValue('iar', $row['iar']);
            //         $template->setValue('drf', $row['drf_num']);
            //         $template->setValue('ptr', $row['ptr_num']);
            //         $template->setValue('drf_date', $row['drf_date']);
            //     }
            // }
            
            // if($row['fundSource'] === 'Donation'){
            //     $filename = 'PAR';
            //     $filePath = storage_path('app/' . $filename . '.docx');
            //     $donation->saveAs($filePath);
            // }else{
            //     $filename = 'PAR';
            //     $filePath = storage_path('app/' . $filename . '.docx');
            //     $template->saveAs($filePath);
            // }
            
            // return response()->download($filePath, $filename . '.docx', [
            //     'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            // ])->deleteFileAfterSend();

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
            ]);
        }
    }
}
