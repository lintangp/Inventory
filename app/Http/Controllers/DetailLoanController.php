<?php

namespace App\Http\Controllers;

use App\Models\DetailLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailLoan = DetailLoan::all();
        return response()->json($detailLoan);
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
            'inventory_id' => 'required',
            'loan_id' => 'required',
            'sum' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation fails',
                'errors' => $validator->errors()
            ],422);
        }

        $detailLoan = DetailLoan::create($request->all());
        return response()->json([
            'message' => 'success',
            'data' => $detailLoan,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailLoan $detailLoan)
    {
        $detailLoan->load('inventory' , 'loan');
        return response()->json([
            'message' => 'success',
            'data' => $detailLoan,
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
        $detailLoan = DetailLoan::findOrFail($id);
        $detailLoan->update([
            'inventory_id' => $request->inventory_id,
            'loan_id' => $request->loan_id,
            'sum' => $request->sum,
        ]);
        return response()->json([
            'message' => 'detail update success',
            'data' => $detailLoan,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DetailLoan::findOrFail($id)->delete();
        return response()->json([
            'message' => 'data deleted'
        ]);
    }
}
