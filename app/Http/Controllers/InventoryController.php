<?php

namespace App\Http\Controllers;
use App\Models\Condition;
use App\Models\Location;
use App\Models\Inventory;
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
        
        
       
        try{
            
            DB::beginTransaction();
                $data = request()->all();
                $itemId = $data['itemId'];
                $condition_id = $data['condition_id'];
                $location_id = $data['location_id'];
                $newcondition_name = $data['newcondition_name'];
                $newlocation_name = $data['newlocation_name'];
                $iar_no = $data['iar_no'];
                $iar_date= $data['iar_date'];
                $delivery_date = $data['delivery_date'];
                $quantity = $data['quantity'];
                $pack_size = $data['pack_size'];
                $loose = $data['loose'];
                $remarks = $data['remarks'];

                if (!$condition_id) {
                    $cond = Condition::create([
                        'conditions_name' => $newcondition_name,
                    ]);
                    $condition_id = $cond->id;
                }
                if (!$location_id) {
                    $loc = Location::create([
                        'location_name' => $newlocation_name,
                    ]);
                    $location_id = $loc->id;
                }

                $inventory = Inventory::create([
                    'Fk_locationId' => $location_id,
                    'Fk_conditionsId' => $condition_id,	
                    'IAR_num'=>$iar_no,
                    'IAR_date'=>$iar_date,
                    'Delivery_date'=>$delivery_date,
                    'Quantity'=>$quantity,
                    'pack_size'=>$pack_size,
                    'loose'=>$loose,
                    'Remarks'=>$remarks,
                    'Fk_itemId' => $itemId,
                ]);
               DB::commit();
                return response()->json([
                    'message' => 'Inventory created successfully',
                    'data' => $inventory
                ], 201);
                 
        }catch(\Throwable $th){
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
