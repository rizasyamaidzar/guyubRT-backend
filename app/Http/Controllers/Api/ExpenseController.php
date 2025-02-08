<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Resources\ResponResource;
use App\Models\Cash;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $expense = Expense::latest()->paginate(5);
        return new ResponResource(true, 'List Data Income', $expense);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'date' => 'required',
            'amount' => 'required',
            'name' => 'required',
            'desc' => 'required',
        ]);
        $cash = Cash::where('id', 1)->first();
        $currentCahsh = $cash->amount - $validated['amount'];
        $cash->update([
            'amount' => $currentCahsh
        ]);
        $expenese = Expense::create($validated);
        return new ResponResource(true, 'Succesfully Created', $expenese);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
        $expense = Expense::where('id', $expense->id)->latest()->paginate(5)->first();
        return new ResponResource(true, 'Detail Data expense', $expense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        //
        $validated = $request->validate([
            'date' => 'required',
            'amount' => 'required',
            'name' => 'required',
            'desc' => 'required',
        ]);
        $expense = Expense::find($expense->id);
        $expense->update($validated);
        return new ResponResource(true, 'Succesfully Created', $expense);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
        $expense = Expense::find($expense->id);
        $expense->delete();
        return new ResponResource(true, 'Delete Succesfully', $expense);
    }
}
