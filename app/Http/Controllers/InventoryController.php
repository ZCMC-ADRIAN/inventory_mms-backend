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
            $delivery_date = $data['delivery_date'];
            $quantity = $data['quantity'];
            $loose = $data['loose'];
            $remarks = $data['remarks'];
            $EditCountry = $data['EditCountry'];
            $EditVariety = $data['EditVariety'];
            $Editacquisition = $data['Editacquisition'];
            $Editdetails = $data['Editdetails'];
            $Editexpiration = $data['Editexpiration'];
            $Editwarranty = $data['Editwarranty'];
            $countryValue = $data['countryValue'];
            $varietyVal = $data['varietyVal'];

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

            if (
                $EditCountry ||
                $EditVariety ||
                $Editacquisition ||
                $Editdetails ||
                $Editexpiration ||
                $Editwarranty ||
                $countryValue ||
                $varietyVal
            ) {
                //find the items and copy the details and modify the needed:
                $EditItem = InsertItem::find($itemId);

                $newItem = $EditItem->replicate();
                $newItem->save();
                echo "Edited Items: ";
                //make country if country id is not present and country value
                //is present, if both are not present NO EDITED SHOULD EXIST
                if (!$EditCountry && $countryValue) {
                    echo "Created new Country";
                    $EditCountry = InsertCountry::create(['country' => $countryValue])->id;
                }
                ////make make Variety same as countries condition 
                if (!$EditVariety && $varietyVal) {
                    echo "Created new Variety" . $varietyVal;
                    $EditVariety = InsertVariety::create(['variety' => $varietyVal])->id;
                }
                //create Item
                $newItem->details2 = $Editdetails ? $Editdetails : $EditItem->details2;
                $newItem->warranty = $Editwarranty ? $Editwarranty : $EditItem->warranty;
                $newItem->acquisition_date = $Editacquisition ? $Editacquisition : $EditItem->acquisition_date;
                $newItem->expiration = $Editexpiration ? $Editexpiration : $EditItem->expiration;
                $newItem->Fk_countryId = $EditCountry ? $EditCountry : $EditItem->Fk_countryId;
                $newItem->Fk_varietyId = $EditVariety ? $EditVariety : $EditItem->Fk_varietyId;
                //save create in items and save it in inventory

                $newItem->save();
                $itemId = $newItem->id;
                dd($newItem);
            }


            $inventory = Inventory::create([
                'Fk_itemId' => $itemId,
                'Fk_conditionsId' => $condition_id,
                'Fk_locatmanId' => $locatman,
                'Delivery_date' => $delivery_date,
                'Quantity' => $quantity,
                'property_no' => $prop_no,
                'serial' => $serial,
                'loose' => $loose,
                'Remarks' => $remarks,
            ]);
            return response()->json([
                'message' => 'Inventory created successfully',
                'data' => $inventory
            ], 201);
            DB::commit();
        } catch (\Throwable $th) {
            return $th;
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th
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