<?php

namespace App\Http\Controllers\v1;

use App\Models\Expense;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExpensesController extends Controller
{


    public function index(Request $request)
    {

        $current_page = $request->input('page', 1);
        $limit = $request->input('limit', 2);

//                $table->id();
//            $table->enum('expense_type', ['operational', 'fuelWithdraw', 'fuelCash', 'maintenance', 'LubricantsOils']);
//            $table->integer('amount');
//            $table->foreignId('vehicle_id')->nullable();
//            $table->foreignId('gas_station_id')->nullable();
//            $table->string('person_name', 255);
//            $table->string('notes', 255)->nullable();
//            $table->timestamps();
//        });


        $expenses = Expense::query()
            ->paginate($limit, ['id', 'expense_type', 'amount', 'created_at'], "page", $current_page)
            ->items();
        return ['data' => $expenses];
    }

    public function show($id)
    {
        try {
            $expense = Expense::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Expense with ID ' . $id . ' not found.'
            ], 404);
        }

        $selectedFields = [];

        switch ($expense->expense_type) {
            case 'LubricantsOils':
            case 'maintenance':
                $selectedFields = ['expense_type', 'amount', 'vehicle_id', 'person_name', 'notes'];
                break;

            case 'operational':
                $selectedFields = ['expense_type', 'amount', 'workshop_id', 'notes'];
                break;

            case 'fuelWithdraw':
            case 'fuelCash':
                $selectedFields = ['expense_type', 'amount', 'gas_station_id', 'vehicle_id', 'notes'];
                break;
        }

        $selected_data = $expense->select($selectedFields)->first();

        return response()->json(['data' => $selected_data]);
    }




    public function update(Request $request, $id)
    {

        try {

            try {
                $expense = Expense::findOrFail($id);
            } catch (ModelNotFoundException $exception) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Expense with ID ' . $id . ' not found.'
                ], 404);
            }
            /*
 *         $table->id();
    $table->enum('expense_type', ['operational', 'fuelWithdraw', 'fuelCash', 'maintenance', 'LubricantsOils']);
    $table->integer('amount');
    $table->foreignId('vehicle_id')->nullable();
    $table->foreignId('gas_station_id')->nullable();
    $table->foreignId('workshop_id')->nullable();
    $table->foreignId('workshop_vehicle_id')->nullable();
    $table->string('person_name', 255);
    $table->string('notes', 255)->nullable();
    $table->timestamps();
});    protected $fillable = ['expense_type', 'amount', 'vehicle_id', 'gas_station_id', 'workshop_id', 'workshop_vehicle_id', 'person_name', 'notes'];
*/

            $validated_payload_data = $request->validate([
                'expense_type' => 'string|in:operational,fuelWithdraw,fuelCash,maintenance,LubricantsOils',
                'amount' => 'numeric',
                ''
            ]);

            $expense->update($validated_payload_data);

            return response()->json(['message' => 'expense updated Successfully With ID: ' . $expense->id, 'data' => $expense], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }


    public function delete($id)
    {

        try {
            $expense = Expense::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Expense with ID ' . $id . ' not found.'
            ], 404);
        }

        $expense->delete();
        return response()->json(['message' => 'expense deleted Successfully '], 200);

    }


}
