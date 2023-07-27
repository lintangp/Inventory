<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Validator;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room = Room::all();
        return response()->json($room);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_name' => 'required',
            'room_code' => 'required',
            'information' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation fails',
                'errors' => $validator->errors()
            ],422);
        }

        $room = Room::create($request->all());
        return response()->json([
            'message' => 'success',
            'data' => $room,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::findOrFail($id);
        return response()->json([
            'message' => 'success',
            'data' => $room,
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
        $room = Room::findOrFail($id);
        
        $room->update([
            'room_name' => $request->room_name,
            'room_code' => $request->room_code,
            'information' => $request->information,
        ]);
        return response()->json([
            'message' => 'room update success',
            'data' => $room,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Room::findOrFail($id)->delete();
        return response()->json([
            'message' => 'data deleted'
        ]);
    }
}
