<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loan = Loan::all();
        return response()->json($loan);
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
            'loan_date' => 'required',
            'return_date' => 'nullable',
            'status' => 'required',
            'employee_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation fails',
                'errors' => $validator->errors()
            ],422);
        }

        $loan = Loan::create($request->all());
        return response()->json([
            'message' => 'success',
            'data' => $loan,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        $loan->load('employee');
        return response()->json([
            'message' => 'success',
            'data' => $loan,
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
        $loan = Loan::findOrFail($id);
        $loan->update([
            'return_date' => $request->return_date,
            'status' => $request->status,
            'employee' => $request->employee,
            
        ]);
        return response()->json([
            'message' => 'room update success',
            'data' => $loan,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Loan::findOrFail($id)->delete();
        return response()->json([
            'message' => 'data deleted'
        ]);
    }
}
