<?php

namespace App\Http\Controllers\v1;

use App\Models\Employee;
use App\Models\EmployeeOvertime;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Exception;

class EmployeeOvertimeController extends Controller
{


    public function add(Request $request, $id)
    {
        try {

            $employee = Employee::find($id);

            if (!$employee) {
                return response()->json(['error' => 'Employee with ID ' . $id . ' not found.'], 404);
            }
            $overtime_validated_data = $request->validate([
                'employee_financial_type' => 'required|in:award,overtime',
                'hours_worked' => $request->input('employee_financial_type') === 'overtime' ? 'required|numeric' : '',
                'rate_per_hour' => $request->input('employee_financial_type') === 'overtime' ? 'required|numeric' : '',
                'amount' => $request->input('employee_financial_type') === 'award' ? 'required|numeric' : ''
            ]);


            $rate_per_hour = $overtime_validated_data['rate_per_hour'];
            $hours_worked = $overtime_validated_data['hours_worked'];
            $inserted_amount = $overtime_validated_data['amount'];
            $amount = $overtime_validated_data['employee_financial_type'] === 'overtime' ? $rate_per_hour * $hours_worked : $inserted_amount;
            $overtime_validated_data['amount'] = $amount;
            $overtime_validated_data['employee_id'] = $id;

            $overtime = EmployeeOvertime::create($overtime_validated_data);

            return response()->json(['message' => 'Overtime added successfully', 'data' => $overtime], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $overtime = EmployeeOvertime::find($id);

            if (!$overtime) {
                return response()->json(['error' => 'Overtime with ID ' . $id . ' not found.'], 404);
            }

            $overtime_validated_data = $request->validate([
                'employee_financial_type' => 'sometimes|in:award,overtime',
                'hours_worked' => [
                    'numeric',
                ],
                'rate_per_hour' => [
                    'numeric',
                ],
                'amount' => [
                    'required_if:employee_financial_type,award',
                    'numeric',
                ],
                'employee_id' => 'numeric',
            ]);

            $employee_financial_type = $overtime_validated_data['employee_financial_type'] ?? $overtime['employee_financial_type'];
            $rate_per_hour = $overtime_validated_data['rate_per_hour'] ?? $overtime['rate_per_hour'];
            $hours_worked = $overtime_validated_data['hours_worked'] ?? $overtime['hours_worked'];
            $inserted_amount = $overtime_validated_data['amount'] ?? $overtime['amount'];


            $amount = $employee_financial_type === 'overtime' ? $rate_per_hour * $hours_worked : $inserted_amount;
            $overtime_validated_data['amount'] = $amount;

            if (key_exists("employee_id", $request->all())) {
                $employee_id = $request->input('employee_id');

                $employee = Employee::find($employee_id);
                if (!$employee) {
                    return response()->json(['error' => 'Employee with ID ' . $employee_id . ' not found.'], 404);
                }
            }

            // Update the existing overtime record
            $overtime->update($overtime_validated_data);

            return response()->json(['message' => 'Overtime updated successfully', 'data' => $overtime], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id){
        try {


            $overtime = EmployeeOvertime::find($id);

            if (!$overtime) {
                return response()->json(['error' => 'Overtime row with ID ' . $id . ' not found.'], 404);
            }
            $overtime->delete();

            return response()->json(['message' => 'overtime row deleted successfully with ID:'.$id]);

        }catch(Exception $e){

            return response()->json(['error'=>$e->getMessage()]);
        }
    }


}
