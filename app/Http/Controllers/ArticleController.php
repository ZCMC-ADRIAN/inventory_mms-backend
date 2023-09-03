<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Type;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Article::all();

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
            $data   = Article::create($request->all());
            // $type   = $request->input('type');
    
            // $article_type = Type::select('id')->where('type', $type)->first();
            // $data->type()->attach($article_type);

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
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            
            $data = Article::findOrFail($id);
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
     * Remove the specified resource in storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Article::findOrFail($id);
            $data->type()->detach($data->id);
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
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function softdelete($id)
    {
        try {
            $data = Article::find($id);

            $data->deleted      = 0;
            $data->created_at   = now();
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
