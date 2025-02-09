<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Resources\ResponResource;
use App\Models\Cash;
use App\Models\Expense;
use App\Models\Home;
use App\Models\Income;
use App\Models\User;
use Illuminate\Http\Request;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cash = Cash::first();
        $totalExpense = Expense::sum('amount');
        $totalHomes = Home::Count();
        $totalUser = User::Count();
        $totalIncome = Income::join('categories', 'incomes.category_id', '=', 'categories.id')
            ->sum('categories.amount');

        return [
            'success'   => 'true',
            'message'   => 'success',
            'data'      => [
                'cash' => $cash['amount'],
                'income' => $totalIncome,
                'expense' => $totalExpense,
                'homes' => $totalHomes,
                'users' => $totalUser
            ]
        ];
    }
    public function chart()
    {
        $incomes = Income::with('category')->get();
        $totalIncomePerMonth = $incomes->groupBy(function ($income) {
            return Carbon::parse($income->date)->format('m');
        })->map(function ($group) {
            return $group->sum(function ($income) {
                return $income->category->amount ?? 0;
            });
        });

        $expenses = Expense::all();
        $totalExpensePerMonth = $expenses->groupBy(function ($expense) {
            return Carbon::parse($expense->date)->format('m');
        })->map(function ($group) {
            return $group->sum('amount');
        });
        return [
            'success'   => 'true',
            'message'   => 'success',
            'data' => [
                'income' => $totalIncomePerMonth,
                'expense' => $totalExpensePerMonth
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cash $cash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cash $cash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cash $cash)
    {
        //
    }
}
