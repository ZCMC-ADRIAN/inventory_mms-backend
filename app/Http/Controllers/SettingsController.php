<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Settings::all();

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
            $data = Settings::create($request->all());

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
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            
            $data = Settings::findOrFail($id);
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
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Settings::findOrFail($id);
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
}
