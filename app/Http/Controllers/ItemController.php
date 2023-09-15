<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;

use App\Models\Item;
use App\Models\Settings;
use App\Models\SettingsData;
use App\Models\Series;
use App\Models\Location;
use App\Models\Associate;
use App\Models\Condition;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // $data = Item::all();
            $data = Item::with(['settings' => function ($quer) {
                $quer->withPivot('settings_id');
            },'settings_data'=> function ($query) {        
                $query->withPivot('settings_data_id');
            }])->get();

            return response()->json([
                'message' => 'Success',
                'data' => $data
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
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
        try {
            $item = Item::create($request->all());

            $data = new Series();

            if ($request['cost'] >= 50000) {

                $series = Helper::PARIDGenerator($data, 'series', 5, 'PAR');

                $data->series        = $series;
                $data->attributes    = 'PAR';
                $data->save();

            } else if($request['cost']< 50000){

                $series = Helper::ICSIDGenerator($data, 'series', 5, 'D');

                $data->series        = $series;
                $data->attributes    = 'ICS';
                $data->save();
            }

            $req = $request->input('data');

            foreach ($req as $data) {
                // $item = Item::create($data);

                $settings       = Settings::select('id')->where('name', $data['settings_name'])->first();
                                $item->settings()->attach($settings);

                $settings_data  = SettingsData::select('id')->where('name', $data['settings_data_name'])->first();
                                $item->settings_data()->attach($settings_data);

                if ($data['location'] != null && $data['associate'] != null && $data['condition'] = null) {
                    $location       = Location::select('id')->where('name', $data['location'])->first();
                                    $item->conditions()->attach($associate);

                    $associate      = Associate::select('id')->where('name', $data['associate'])->first();
                                    $item->conditions()->attach($associate);

                    $condition      = Condition::select('id')->where('name', $data['condition'])->first();
                                    $item->conditions()->attach($condition);

                }
            }

            return response()->json([
                'message' => 'Success',
                'data' => $request
            ], 200);

            

        } catch (\Throwable $th) {

            return response()->json([
                'message' => $th->getMessage()
            ], 500);
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
