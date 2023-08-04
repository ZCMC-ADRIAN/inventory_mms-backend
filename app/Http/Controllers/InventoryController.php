<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use App\Models\Location;
use App\Models\Associate;
use App\Models\Inventory;
use App\Models\Locatman;
use App\Models\InsertItem;
use App\Models\InsertCountry;
use App\Models\InsertVariety;
use App\Models\InsertPropertyNo;
use App\Models\InsertICSSeries;
use App\Models\InsertPARSeries;
use App\Models\InsertICSNum;
use App\Models\InsertPARNum;
use App\Models\InsertItemRelation;
use App\Models\InsertICSDetails;
use App\Models\InsertPARDetails;
use App\Models\InsertFundCluster;
use App\Models\PO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Validator;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //NEW
        // property_no
        // serial

        try {

            DB::beginTransaction();
            $data = request()->all();
            $itemId = $data['itemId'];
            $condition_id = $data['condition_id'];
            $location_id = $data['location_id'];
            $assoc_id = $data['assoc_id'];
            $newcondition_name = $data['newcondition_name'];
            $newlocation_name = $data['newlocation_name'];
            $newAssoc_name = $data['newAssoc_name'];
            $prop_no = $data['property_no'];
            $serial = $data['serial'];
            $barcode = $data['barcode'];
            $delivery_date = $data['delivery_date'];
            $quantity = $data['quantity'];
            $remarks = $data['remarks'];
            $newProp = $data['newProperty'];
            $icsNumber = $data['icsNumber'];
            $parNumber = $data['parNumber'];
            $poNumber = $data['poNum'];
            $cost = $data['cost'];
            $oldPAR = $data['oldPAR'];
            $Pk_propertyId = null;

            $getCost = DB::table('items')->select('cost')->where('Pk_itemId', $itemId)->get();

            foreach($getCost as $resCost){
                $costs = $resCost->cost;
            }
            
            $parSeries = DB::table('par_series')->select('series')->get();
            $icsSeries = DB::table('ics_series')->select('series')->get();

            if ($request->inv === true) {
                $seriesPAR = 0;
                if ($costs >= 50000) {
                    foreach ($parSeries as $par) {
                        $seriesPAR = $par->series;
                    }
                    $PAR = new InsertPARSeries();
                    $PAR->series = $seriesPAR + 1;
                    $PAR->save();

                    $property = new InsertPropertyNo();
                    $property->Fk_parId = $PAR->Pk_parId;
                    $property->type = 1;
                    $property->save();

                }elseif ($costs < 50000){
                    $seriesICS = 0;
                    foreach ($icsSeries as $ics){
                        $seriesICS = $ics->series;
                    }
                    $ICS = new InsertICSSeries();
                    $ICS->series = $seriesICS + 1;
                    $ICS->save();

                    $property = new InsertPropertyNo();
                    $property->Fk_icsId = $ICS->Pk_icsId;
                    $property->type = 0;
                    $property->save();
                }
            }

           //check muna if nag exist na ang Id ng ics_no sa assoc_relation table
        //    $check = InsertItemRelation::where('Fk_assocId', $assoc_id)->pluck('Fk_assocId')->first();
           $columnPAR = 'Fk_parNumId';
           $columnICS = 'Fk_icsNumId';

           $existingPo = PO::where('po_number', $poNumber)->first();

           if (!empty($poNumber)) {
           
               if ($existingPo) {
                   $poId = $existingPo->Pk_poId;
               } else {
                   $po = PO::create([
                       'po_number' => $poNumber,
                   ]);
                   $poId = $po->Pk_poId;
               }
           }

           if (!$existingPo) {
            if ($cost < 50000) {
                $icsNumbers = DB::table('ics_no')->max('series');
        
                $saveNumSeries = new InsertICSNum();
                $saveNumSeries->series = $icsNumbers + 1;
                $saveNumSeries->save();
                $saveNumSeriesId = $saveNumSeries->Pk_icsNumId;
            } elseif ($cost >= 50000) {
                $parNumbers = DB::table('par_no')->max('series');
        
                $saveParSeries = new InsertPARNum();
                $saveParSeries->series = $parNumbers + 1;
                $saveParSeries->save();
                $saveParSeriesId = $saveParSeries->Pk_parNumId;
            }
        }

        $cluster = DB::table('fundcluster')->where('fundCluster', $request->fundCluster)->count();
        $clusterId = null;
        if ($request->fundCluster != '') {
            if ($cluster < 1) {
                $cluster = new InsertFundCluster();
                $cluster->fundCluster = $request->fundCluster;
                $cluster->save();
                $clusterId = $cluster->getKey();
            } else {
                $resCluster = DB::table('fundcluster')->select('Pk_fundClusterId')->where('fundCluster', $request->fundCluster)->get();

                foreach ($resCluster as $resClus) {
                    $clusterId = $resClus->Pk_fundClusterId;
                }
            }
        }
        

        if($request->po != '' && $request->cost < 50000 && !$existingPo){
            $details = new InsertICSDetails();
            $details->Fk_fundClusterId = $clusterId;
            $details->po_date = $request->poDate;
            $details->invoice = $request->invoiceNum;
            $details->invoiceDate = $request->invoiceRec;
            $details->ors = $request->ors;
            $details->iar = $request->IAR;
            $details->drf = $request->DRF;
            $details->drf_date = $request->DRFDate;
            $details->ptr_num = $request->PTR;
            $details->save();

            $detailsId = DB::table('ics_details')->select('Pk_icsDetails')->get();

            foreach($detailsId as $resICS){
                $icsId = $resICS->Pk_icsDetails;
            }
        }else{
            $icsId = null;
        }
        
        if (!empty($request->po) && $request->cost > 50000 && !$existingPo) {
            $par_details = new InsertPARDetails();
            $par_details->fill([
                'Fk_fundClusterId' => $clusterId,
                'drf' => $request->DRF,
                'drf_date' => $request->DRFDate,
                'iar' => $request->IAR,
                'invoice' => $request->invoiceNum,
                'po_date' => $request->poDate,
                'ors_num' => $request->ors,
                'po_conformed' => $request->poConformed,
                'invoice_rec' => $request->invoiceRec,
                'ptr_num' => $request->PTR,
            ]);
            $par_details->save();
        
            $parId = $par_details->Pk_parDetails;
        } else {
            $parId = null;
        }  

            $propertyNo = DB::table('propertyno')->select('Pk_propertyId')->orderBy('created_at', 'desc')->first();

            if ($propertyNo) {
                $Pk_propertyId = $propertyNo->Pk_propertyId;
            }
            
            $isnew = false;
            if (!$condition_id) {
                $cond = Condition::create([
                    'conditions_name' => $newcondition_name,
                ]);
                $condition_id = $cond->id;
                echo 'condition selected is empty: created new condion';
            }
            if (!$location_id) {
                $loc = Location::create([
                    'location_name' => $newlocation_name,
                ]);
                $location_id = $loc->id;
                echo 'location selected is empty: created new loc';
                $isnew = true;
            }
            if (!$assoc_id) {
                $assoc = Associate::create([
                    'person_name' => $newAssoc_name,
                ]);
                $assoc_id = $assoc->id;
                echo 'assoc selected is empty: created new assoc';
                $isnew = true;
            }
            
            if($request-> inv === true){
                $itemRelationId = Inventory::where('Fk_itemId', $itemId)->pluck('Fk_item_relationId')->first();
            }else{  
                if(!$existingPo){
                    $itemRelation = new InsertItemRelation;
                    $itemRelation->Fk_poId = $poId;
                    $itemRelation->Fk_icsNumId = empty($saveNumSeriesId) ? NULL : $saveNumSeriesId;
                    $itemRelation->Fk_parNumId = empty($saveParSeriesId) ? NULL : $saveParSeriesId;
                    $itemRelation->Fk_icsDetailsId = $icsId;
                    $itemRelation->Fk_parDetailsId = $parId;
                    $itemRelation->ics_number = $cost < 50000 ? $icsNumber : NULL;
                    $itemRelation->old_parNum = $oldPAR;
                    $itemRelation->par_number = $cost >= 50000 ? $parNumber : NULL;
                    $itemRelation->save();
                    $itemRelationId = $itemRelation->Pk_item_relationId;
                }else{
                    $checkExistingPO = InsertItemRelation::where('Fk_poId', $poId)->first();
                    $itemRelationId = $checkExistingPO->Pk_item_relationId;
                }
            }
            
            
            
            if (!$isnew) {
                echo 'find in db and try to get the id of the locatman';
                $locatman = get_object_vars(DB::table('locat_man')
                    ->select()
                    ->where('Fk_assocId', '=', $assoc_id)
                    ->where('Fk_locationId', '=', $location_id)
                    ->first())['Pk_locatmanId'];
            } else {
                echo 'sssss';
                $locatman = Locatman::create([
                    'Fk_assocId' => $assoc_id,
                    'Fk_locationId' => $location_id,
                ])->id;
            }

            $inventory = Inventory::create([
                'Fk_itemId' => $itemId,
                'Fk_conditionsId' => $condition_id,
                'Fk_locatmanId' => $locatman,
                'Fk_propertyId' => $Pk_propertyId,
                'Fk_item_relationId' => $itemRelationId,
                'Delivery_date' => $delivery_date,
                'Quantity' => $quantity,
                'property_no' => $prop_no,
                'newProperty' => $newProp,
                'serial' => $serial,
                'barcode' => $barcode,
                'Remarks' => $remarks,
            ]);

            DB::commit();
            return response()->json([
                'message' => 'Inventory created successfully',
                'data' => $inventory
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
