<?php

namespace App\Http\Controllers;

use App\Models\SettingsData;
use Illuminate\Http\Request;

class SettingsDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = SettingsData::all();

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // $data = Settings::create($request->all());
            
            $data = $request->input('items');

            foreach ($data as $item) {
                SettingsData::create($item);
            }  

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
     * Display the specified resource.
     *
     * @param  \App\Models\SettingsData  $settingsData
     * @return \Illuminate\Http\Response
     */
    public function show(SettingsData $settingsData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingsData  $settingsData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            
            $data = SettingsData::findOrFail($id);
            $data->update($request->all());

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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingsData  $settingsData
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = SettingsData::findOrFail($id);
            $data->delete();

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
     * Deactivate the specified resource from storage.
     *
     * @param  \App\Models\SettingsData  $Series
     * @return \Illuminate\Http\Response
     */
    public function softdelete($id)
    {
        try {
            $data = SettingsData::find($id);

            $data->deleted      = 0;
            $data->updated_at   = now();
            $data->save();
        
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
}
