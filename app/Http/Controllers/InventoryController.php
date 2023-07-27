<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventory = Inventory::all();
        return response()->json($inventory);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inventory_name' => 'required',
            'information' => 'required',
            'sum' => 'required',
            'type_id' => 'required',
            'room_id' => 'required',
            'inventory_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation fails',
                'errors' => $validator->errors()
            ],422);
        }

        $inventory = Inventory::create($request->all());
        return response()->json([
            'message' => 'success',
            'data' => $inventory,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        $inventory->load('room' , 'type');
        return response()->json([
            'message' => 'success',
            'data' => $inventory,
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->update([
            'inventory_name' => $request->inventory_name,
            'information' => $request->information,
            'sum' => $request->sum,
            'type_id' => $request->type_id,
            'room_id' => $request->room_id,
            'inventory_code' => $request->room_id,
            
        ]);
        return response()->json([
            'message' => 'room update success',
            'data' => $inventory,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Inventory::findOrFail($id)->delete();
        return response()->json([
            'message' => 'data deleted'
        ]);
    }
}
