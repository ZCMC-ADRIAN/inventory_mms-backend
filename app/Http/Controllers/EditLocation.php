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
            $condition_id = $data['condition_id'];
            $location_id = $data['location_id'];
            $assoc_id = $data['assoc_id'];
            $newcondition_name = $data['newcondition_name'];
            $newlocation_name = $data['newlocation_name'];
            $newAssoc_name = $data['newAssoc_name'];
            $prop_no = $data['property_no'];
            $serial = $data['serial'];
            $delivery_date = $data['delivery_date'];
            $remarks = $data['remarks'];

            $currData = DB::select('SELECT * FROM inventories LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId WHERE Pk_inventoryId = ?', ["$req->inventoryId"]);

            $con_name = DB::table('conditions')->where('conditions_name', $newcondition_name)->count();
            $loc_name = DB::table('location')->where('location_name', $newlocation_name)->count();
            $assoc_name = DB::table('associate')->where('person_name', $newAssoc_name)->count();

            // foreach($currData as $data){
            //     $condId = $data->Fk_conditionsId;
            //     $locatId = $data->Fk_locatmanId;
            //     $date = $data->Delivery_date;
            //     $property = $data->property_no;
            //     $serNum = $data->serial;
            //     $rem = $data->Remarks;
            // }

            $isnew = false;

            //For Conditions
            if (!$condition_id) {
                if ($con_name === 0) {
                    $cond = Condition::create([
                        'conditions_name' => $newcondition_name,
                    ]);
                    $condition_id = $cond->id;
                } else {
                    foreach ($currData as $data) {
                        $condId = $data->Fk_conditionsId;
                    }
                    $condition_id = $condId;
                }
            }

            //For Locations
            if (!$location_id) {
                $loc = Location::create([
                    'location_name' => $newlocation_name,
                ]);
                $location_id = $loc->id;
                echo 'location selected is empty: created new loc';
                $isnew = true;
            }


            //For Associates
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


            DB::table('inventories')->where('Pk_inventoryId', $req->inventoryId)->update(['Fk_conditionsId' => $condition_id, 'Fk_locatmanId' => $locatman, 'Delivery_date' => $delivery_date, 'property_no' =>  $prop_no, 'serial' => $serial, 'Remarks' => $remarks]);

            DB::commit();
            return response()->json([
                "status" => 1
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th
            ]);
        }
    }
}
