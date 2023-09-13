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
use App\Models\Series;
use App\Models\InsertItemRelation;
use App\Models\Regular;
use App\Models\InsertFundCluster;
use App\Models\ItemAttributes;
use App\Models\RegularSeries;
use App\Models\DonationSeries;
use App\Models\PO;
use App\Models\PAR;
use App\Models\ICS;
use App\Models\Donation;
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

            $itemId             = $data['itemId'];
            $condition_id       = $data['condition_id'];
            $location_id        = $data['location_id'];
            $assoc_id           = $data['assoc_id'];
            $newcondition_name  = $data['newcondition_name'];
            $newlocation_name   = $data['newlocation_name'];
            $newAssoc_name      = $data['newAssoc_name'];
            $prop_no            = $data['property_no'];
            $serial             = $data['serial'];
            $barcode            = $data['barcode'];
            $delivery_date      = $data['delivery_date'];
            $quantity           = $data['quantity'];
            $remarks            = $data['remarks'];
            $newProp            = $data['newProperty'];
            $poNumber           = $data['poNum'];
            $drf                = $data['DRF'];
            $drfDate            = $data['DRFDate'];
            $ptr                = $data['PTR'];
            $cost               = $data['cost'];
            $oldPAR             = $data['oldPAR'];
            $mode               = $data['acquiMode'];
            $Pk_propertyId      = null;
            $isPersonId         = null;
            $poId               = null;
            $regularId          = null;
            $donation_seriesId  = null;
            $icsNumber = ($mode === 'Regular') ? $data['icsNumber'] : 'D' . $data['icsNumber'];
            $parNumber = ($mode === 'Regular') ? $data['parNumber'] : 'D' . $data['parNumber'];


            $costs = DB::table('items')
            ->where('Pk_itemId', $itemId)
            ->value('cost');

            $joinTable = $costs >= 50000 ? 'par' : 'ics';

            $checkingPO = DB::table('inventories')
            ->select('Fk_person_ID', 'Pk_poId', 'regular_series.id AS series_id')
            ->leftJoin('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
            ->leftJoin('item_attributes', 'inventories.Fk_item_attributes', '=', 'item_attributes.id')
            ->leftJoin($joinTable, 'item_attributes.Fk_' . $joinTable . '_ID', '=', $joinTable . '.id')
            ->leftJoin('regular_series', 'item_attributes.Fk_regular_series', '=', 'regular_series.id')
            ->leftJoin('po_number', 'item_attributes.Fk_po_ID', '=', 'po_number.Pk_poId')
            ->where('Fk_itemId', $itemId)
            ->get();

            $assocIdInCheckingPO = false;

            foreach ($checkingPO as $entry) {
                $regularId = $entry->series_id;
                if ($entry->Fk_person_ID === $assoc_id) {
                    $assocIdInCheckingPO = true;
                    break;
                }
            }
            
            $parSeries = DB::table('par_property_series')->select('series')->get();
            $icsSeries = DB::table('ics_property_series')->select('series')->get();

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
                    $property->Fk_parId = $PAR->id;
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
                    $property->Fk_icsId = $ICS->id;
                    $property->type = 0;
                    $property->save();
                }
            }
            
            $existingPo = PO::where('po_number', $poNumber)->first();

            if($request->inv === false){
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
            }else {
                $regularId = $entry->series_id;
                $poId = $entry->Pk_poId;
            }

        if (!$existingPo || !$assocIdInCheckingPO || !$drf) {
            $series = new Series();
            $series->series = Series::where('attributes', $cost < 50000 ? 'ICS' : 'PAR')->max('series') + 1;
            $series->attributes = $cost < 50000 ? 'ICS' : 'PAR';
            $series->status = $cost < 50000 ? 'BELOW' : 'ABOVE';
            $series->save();
            $savedSeriesId = $series->id;
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

            if($request->inv === true){
                $checkRegular = DB::table('inventories')
                ->select('regular.id')
                ->leftJoin('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                ->leftJoin('item_attributes', 'inventories.Fk_item_attributes', '=', 'item_attributes.id')
                ->leftJoin('regular_series', 'item_attributes.Fk_regular_series', '=', 'regular_series.id')
                ->leftJoin('regular', 'regular_series.Fk_regular_ID', '=', 'regular.id')
                ->where('Fk_itemId', $itemId)
                ->get();            

                foreach($checkRegular as $getRegular){
                    $regularId = $getRegular->id;
                }
            }else {
                if (!empty($drf) || !empty($request->po) && ($request->cost > 50000 || $request->cost < 50000) && !$existingPo) {
                    if($mode === 'Regular'){
                        $regular = new Regular();
                        $regular->fill([
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
                        $regular->save();
                        $regularId = $regular->id;
        
                        $regular_series = new RegularSeries();
                        $regular_series->fill([
                            'Fk_regular_ID' => $regularId,
                            'Fk_series_ID' => $savedSeriesId
                        ]);
                        $regular_series->save();
                        $regular_seriesId = $regular_series->id;
                    }else{
                        $donate = new Donation();
                        $donate->drf_num = $drf;
                        $donate->ptr_num = $ptr;
                        $donate->drf_date = $drfDate;
                        $donate->save();
                        $donateId = $donate->id;

                        $donation_series = new DonationSeries();
                        $donation_series->Fk_donation_ID = $donateId;
                        $donation_series->Fk_series_ID = $savedSeriesId;
                        $donation_series->save();
                        $donation_seriesId = $donation_series->id;
                    }
                }
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

            if (!$assocIdInCheckingPO) {
                $PAR = ($cost >= 50000 || $costs >= 50000) ? new PAR() : new ICS();
                $itemField = ($cost >= 50000 || $costs >= 50000) ? 'par_number' : 'ics_number';
                $itemIdField = ($cost >= 50000 || $costs >= 50000) ? 'Fk_par_ID' : 'Fk_ics_ID';
                
                $PAR->fill([
                    'Fk_person_ID' => $assoc_id,
                    $itemField => ($cost >= 50000 || $costs >= 50000) ? $parNumber : $icsNumber
                ]);
                $PAR->save();
                $PARId = $PAR->id;

                $attributes = new ItemAttributes();
                $attributes->fill([
                    'Fk_po_ID' => $poId,
                    $itemIdField => $PARId,
                    'Fk_regular_series' => $regularId,
                    'Fk_donation_series' => $donation_seriesId
                ]);
                $attributes->save();
                $attributesId = $attributes->id;

            }else{
                $attributesId = DB::table('item_attributes') 
                ->select('item_attributes.id')
                ->leftJoin('po_number', 'item_attributes.Fk_po_ID', '=', 'po_number.Pk_poId')
                ->leftJoin($joinTable, 'item_attributes.Fk_' . $joinTable . '_ID', '=', $joinTable . '.id')
                ->leftJoin('associate', 'Pk_assocId', '=',  "$joinTable.Fk_person_ID")
                ->where('Pk_poId', $poId)
                ->where('Fk_person_ID', $assoc_id)
                ->value('item_attributes.id');
            }

            $inventory = Inventory::create([
                'Fk_itemId' => $itemId,
                'Fk_conditionsId' => $condition_id,
                'Fk_locatmanId' => $locatman,
                'Fk_propertyId' => $Pk_propertyId,
                'Fk_item_attributes' => $attributesId,   
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
