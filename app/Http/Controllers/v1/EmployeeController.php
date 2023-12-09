<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{

    /**
     * @param Request $request
     * @return array
     */

    public function index(Request $request)

    {
        $current_page = $request->input('page', 1);
        $limit = $request->input('limit', 2);
        $employees = Employee::query()
            ->paginate($limit, ['id', 'name', 'national_id', 'phone', 'status', 'created_at'], "page", $current_page)
            ->items();

        return ['data' => $employees];
    }

    public function show($id)
    {

        $employee = Employee::query()
            ->with(["payments:id,payment_type,employee_id,amount,date", "overtimes:id,employee_id,employee_financial_type,amount"])
            ->find($id, ['id', 'name', 'national_id', 'phone', 'status', 'created_at']);

        if (!$employee) {
            return response()->json([
                'status' => 404,
                'error' => 'Employee With ID: ' . $id . ' not font'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $employee
        ]);
    }

    public function create(Request $request)
    {
        try {
            $validated_payload_data = $request->validate([
                'name' => 'required|string|max:255',
                'national_id' => [
                    'required',
                    'string',
                    'size:9',
                    Rule::unique('employees'),
                ],
                'phone' => [
                    'required',
                    'string',
                    'size:10',
                    Rule::unique('employees'),
                ],
                'salary' => 'required|numeric',
                'status' => 'in:active,notActive'
            ]);
            $employee = Employee::create($validated_payload_data);
            $employee->save();

            return response()->json(['message' => 'Employee Created Successfully With ID: ' . $employee->id, 'data' => $employee], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }


    public function update(Request $request, $id)
    {

        try {

            $employee = Employee::find($id);

            if (!$employee) {
                return response()->json(['error' => 'Employee with ID ' . $id . ' not found.'], 404);
            }

            $validated_request_data = $request->validate([
                'name' => 'string|max:255',
                'national_id' => [
                    'string',
                    'max:255',
                    Rule::unique('employees')->ignore($id),
                ],
                'phone' => 'string|max:255',
                'salary' => 'numeric',
                'status' => 'in:active,notActive',
            ]);


            $employee->update($validated_request_data);

            $employee->save();

            return response()->json(['message' => 'Employee successfully updated with ID:' . $id, 'data' => $employee], 200);

        } catch (ValidationException $e) {

            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }

    public function delete($id)
    {

        try {
            $employee = Employee::find($id);

            if (!$employee) {
                return response()->json(['error' => 'Employee With ID: ' . $id . ' not font '], 404);
            }

            $employee->delete();

            return response()->json(['message' => 'Employee deleted successfully with ID:' . $id]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee With ID: ' . $id . ' not font '], 404);
        }

    }

}
