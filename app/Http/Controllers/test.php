<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InsertArticle;
use App\Models\InsertTypes;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $request)
    {
        try {
            $PO = DB::table('po_number')->select('po_number')->get();

            return response()->json($PO);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }
}
