<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

use Illuminate\Support\Facades\DB;
class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        //
        try {
            if ($request->has('q')) {
                # search item
                $q = $request->input('q');
                $types = DB::select("SELECT * FROM types WHERE type_name LIKE ?", ["%$q%"]);
                return response()->json($types);
            } else {
                # code...
                $types= DB::table('types')->get();
                return response()->json($types);
            }
        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'status' => 500,
                'message' => $th
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
        try{
            $loc = new Location;
            $loc->location_name = $request['loc_name'];
            $loc->save();
            return response("successfully save location");
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
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
