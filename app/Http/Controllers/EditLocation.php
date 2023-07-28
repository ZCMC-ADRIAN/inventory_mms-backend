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
            $data = $req->all();
            $condition_id = $data['condition_id'] ?? null;
            $location_id = $data['location_id'] ?? null;
            $assoc_id = $data['assoc_id'] ?? null;
            $newcondition_name = $data['newcondition_name'];
            $newlocation_name = $data['newlocation_name'];
            $newAssoc_name = $data['newAssoc_name'];
            $prop_no = $data['property_no'];
            $serial = $data['serial'];
            $delivery_date = $data['delivery_date'];
            $remarks = $data['remarks'];

            $currData = DB::table('inventories')
                ->leftJoin('locat_man', 'inventories.Fk_locatmanId', '=', 'locat_man.Pk_locatmanId')
                ->where('Pk_inventoryId', $req->inventoryId)
                ->select('inventories.*', 'inventories.Remarks', 'inventories.Delivery_date', 'inventories.property_no', 'inventories.serial')
                ->get();

            if (!$remarks) {
                $remarks = $currData->first()->Remarks;
            }

            if (!$delivery_date) {
                $delivery_date = $currData->first()->Delivery_date;
            }

            if (!$prop_no) {
                $prop_no = $currData->first()->property_no;
            }

            if (!$serial) {
                $serial = $currData->first()->serial;
            }

            $isnew = false;

            // For Conditions
            if (!$condition_id) {
                $con_name = Condition::where('conditions_name', $newcondition_name)->count();
                if ($con_name === 0) {
                    $condition = Condition::create([
                        'conditions_name' => $newcondition_name,
                    ]);
                    $condition_id = $condition->id;
                } else {
                    $condition_id = $currData->first()->Fk_conditionsId;
                }
            }

            // For Locations
            if (!$location_id) {
                if (!empty($newlocation_name)) {
                    $location = Location::create([
                        'location_name' => $newlocation_name,
                    ]);
                    $location_id = $location->id;
                    $isnew = true;
                } else {
                    $location_id = $currData->first()->Fk_locationId;
                }
            }

            // For Associates
            if (!$assoc_id) {
                if (!empty($newAssoc_name)) {
                    $associate = Associate::create([
                        'person_name' => $newAssoc_name,
                    ]);
                    $assoc_id = $associate->id;
                    $isnew = true;
                } else {
                    $assoc_id = $currData->first()->Fk_assocId;
                }
            }

            if (!$isnew) {
                $locatman = Locatman::where('Fk_assocId', $assoc_id)
                    ->where('Fk_locationId', $location_id)
                    ->value('Pk_locatmanId');
            } else {
                $locatman = Locatman::create([
                    'Fk_assocId' => $assoc_id,
                    'Fk_locationId' => $location_id,
                ])->id;
            }

            DB::table('inventories')
                ->where('Pk_inventoryId', $req->inventoryId)
                ->update([
                    'Fk_conditionsId' => $condition_id,
                    'Fk_locatmanId' => $locatman,
                    'Delivery_date' => $delivery_date,
                    'property_no' => $prop_no,
                    'serial' => $serial,
                    'Remarks' => $remarks,
                ]);

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
