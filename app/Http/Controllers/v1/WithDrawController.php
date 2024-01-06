<?php

namespace App\Http\Controllers\v1;

use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Models\GasStation;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;

class WithDrawController extends Controller
{
    public function store(Request $request, $id)
    {
        // add fuelWithdraw expense
        $validatedData = $request->validate([
            'gas_station_id' => 'required',
            'expense_type' => 'required|in:fuelWithdraw',
            'amount' => 'required|numeric|min:0',
        ]);

        $gasStation = GasStation::findOrFail($id);

        // Check if the gas station has enough balance
        if ($gasStation->current_balance < $validatedData['amount']) {
            return response()->json(['error' => 'Not enough balance'], 400);
        }

        // Deduct the amount from the gas station's current balance
        $gasStation->current_balance -= $validatedData['amount'];
        $gasStation->save();

        // Create a new expense
        $expense = Expense::create($validatedData);

        $expense->save();

        return response()->json([
            'message' => 'Withdrawal successful',
            'expense' => new ExpenseResource($expense)
        ], 201);
    }
}
