<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Models\Associate;
use App\Models\Condition;
use App\Models\Inventory;
use App\Models\Locatman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditLocation extends Controller
{
    public function editLocation(Request $req)
    {
        try {
            DB::beginTransaction();
            $data = request()->all();
            $condition_id = isset($data['condition_id']) ? $data['condition_id'] : null;
            $location_id = isset($data['location_id']) ? $data['location_id'] : null;
            $assoc_id = isset($data['assoc_id']) ? $data['assoc_id'] : null;
            $newcondition_name = $data['newcondition_name'];
            $newlocation_name = $data['newlocation_name'];
            $newAssoc_name = $data['newAssoc_name'];
            $prop_no = $data['property_no'];
            $serial = $data['serial'];
            $delivery_date = $data['delivery_date'];
            $remarks = $data['remarks'];
            

            $currData = DB::select('SELECT * FROM inventories LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId WHERE Pk_inventoryId = ?', ["$req->inventoryId"]);

            $con_name = DB::table('conditions')->where('conditions_name', $newcondition_name)->count();

            if(!$remarks){
                foreach($currData as $det){
                    $getRemarks = $det->Remarks;
                }
                $remarks = $getRemarks;
            }

            if(!$delivery_date){
                foreach($currData as $det){
                    $getDelivery = $det->Delivery_date;
                }
                $delivery_date = $getDelivery;
            }

            if(!$prop_no){
                foreach($currData as $det){
                    $getProp = $det->property_no;
                }
                $prop_no = $getProp;
            }

            if(!$serial){
                foreach($currData as $det){
                    $getSerial = $det->serial;
                }
                $serial = $getSerial;
            }
            

            $isnew = false;
            //For Conditions
            if (!$condition_id) {
                if ($con_name === 0) {
                    $cond = Condition::create([
                        'conditions_name' => $newcondition_name,
                    ]);
                    $condition_id = $cond->id;
                } else {
                    foreach ($currData as $datas) {
                        $condId = $datas->Fk_conditionsId;
                    }
                    $condition_id = $condId;
                }
            }

            //For Locations
            if (!$location_id) {
                if (!empty($newlocation_name)) {
                    $loc = Location::create([
                        'location_name' => $newlocation_name,
                    ]);
                    $location_id = $loc->id;
                    echo 'location selected is empty: created new loc';
                    $isnew = true;
                } else {
                    foreach ($currData as $data) {
                        $locID = $data->Fk_locationId;
                    }
                    $location_id = $locID;
                }
            }


            //For Associates
            if (!$assoc_id) {
                if(!empty($newAssoc_name)){
                    $assoc = Associate::create([
                        'person_name' => $newAssoc_name,
                    ]);
                    $assoc_id = $assoc->id;
                    echo 'assoc selected is empty: created new assoc';
                    $isnew = true;
                }else{
                    foreach ($currData as $data) {
                        $assocID = $data->Fk_assocId;
                    }
                    $assoc_id = $assocID;
                }
            }



            if (!$isnew) {
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


            DB::table('inventories')->where('Pk_inventoryId', $req->inventoryId)->update(['Fk_conditionsId' => $condition_id, 'Fk_locatmanId' => $locatman, 'Delivery_date' => $delivery_date, 'property_no' =>  $prop_no, 'serial' => $serial, 'Remarks' => $remarks]);
            

            DB::commit();
            return response()->json([
                "status" => 1
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }
}
