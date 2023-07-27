<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = Type::all();
        return response()->json($type);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_name' => 'required',
            'code' => 'required',
            'information' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation fails',
                'errors' => $validator->errors()
            ],422);
        }

        $type = Type::create($request->all());
        return response()->json([
            'message' => 'success',
            'data' => $type,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type = Type::findOrFail($id);
        return response()->json([
            'message' => 'success',
            'data' => $type,
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
        $type = Type::findOrFail($id);
        
        $type->update([
            'type_name' => $request->type_name,
            'code' => $request->code,
            'information' => $request->information,
        ]);
        return response()->json([
            'message' => 'type update success',
            'data' => $type,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Type::findOrFail($id)->delete();
        return response()->json([
            'message' => 'data deleted'
        ]);
    }
}