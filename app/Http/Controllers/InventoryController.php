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
            $remarks = $data['remarks'];
            $newProp = $data['newProperty'];
            $Pk_propertyId = null;

            // //To be Continue
            // $items = DB::select('SELECT Fk_propertyId, Pk_inventoryId, `serial`, barcode, location_name, person_name, code, series, area_code FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON itemcateg.Pk_itemCategId = items.Fk_itemCategId LEFT JOIN propertyno ON propertyno.Pk_propertyId = inventories.Fk_propertyId LEFT JOIN par_series ON propertyno.Fk_parId = par_series.Pk_parId WHERE Pk_itemId = ?', ["$itemId"]);
            
            // foreach($items as $info){
            //     $propertId = $info->Fk_propertyId;
            //     $inventoryId = $info->Pk_inventoryId;
                
            //     $year = '2023';
            //     $categ_code = $info->code;
            //     $series = $info->series;
            //     $area_code = $info->area_code;
            // }

            // $propertyNum = $year.'-'.$categ_code.'-'.$series.'-'.$area_code;
            
            if (!$prop_no) {
                $propertyNo = DB::table('propertyno')->select('Pk_propertyId')->orderBy('created_at', 'desc')->first();

                if ($propertyNo) {
                    $Pk_propertyId = $propertyNo->Pk_propertyId;
                }
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

            $inventory = Inventory::create([
                'Fk_itemId' => $itemId,
                'Fk_conditionsId' => $condition_id,
                'Fk_locatmanId' => $locatman,
                'Fk_propertyId' => $Pk_propertyId,
                'Delivery_date' => $delivery_date,
                'Quantity' => $quantity,
                'property_no' => $newProp,
                'serial' => $serial,
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
