<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponResource;
use App\Models\Cash;
use App\Models\Category;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $income = Income::with('user')->with('category')->latest()->paginate(5);
        return new ResponResource(true, 'List Data Income', $income);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'date' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);
        $amountPrice = Category::where("id", $validated['category_id'])->first();
        // dd($amountPrice->amount);
        $cash = Cash::where('id', 1)->first();
        $currentCahsh = $cash->amount + $amountPrice->amount;
        $cash->update([
            'amount' => $currentCahsh
        ]);
        $income = Income::create($validated);
        return new ResponResource(true, 'Succesfully Created', $income);
    }

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        //
        $income = Income::with('user')->with('category')->where('id', $income->id)->latest()->paginate(5)->first();
        return new ResponResource(true, 'Detail Data Income', $income);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Income $income)
    {
        //
        $validated = $request->validate([
            'date' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        $income = Income::find($income->id);
        $income->update($validated);
        return new ResponResource(true, 'Succesfully Created', $income);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        //
        $income = Income::find($income->id);
        $income->delete();
        return new ResponResource(true, 'Delete Succesfully', $income);
    }
}
