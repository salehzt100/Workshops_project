<?php

namespace App\Http\Controllers\v1;
use App\Models\VehicleIncome;
use App\Models\VehicleWorkshops;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VehicleIncomesController extends Controller
{


    public function index(Request $request)
    {
        $current_page = $request->input('page', 1);
        $limit = $request->input('limit', 2);
        $selected=['vehicle_workshop_id','hours_worked','hourly_rate','created_at'];

        $vehiclesIncomes = VehicleIncome::query()
            ->paginate($limit,$selected , "page", $current_page)
            ->items();

        return ['data' => $vehiclesIncomes];
    }

    public function show($id)
    {
        $income = VehicleIncome::find($id);

        if (!$income){
            return response()->json([
                'status' => 404,
                'error' => 'vehicle income  with ID ' . $id . ' not found.'
            ], 404);

        }
        return ['data' => $income];
    }

    public function update(Request $request,$id){

        try {
            $income = VehicleIncome::find($id);

            if (!$income){
                return response()->json([
                    'status' => 404,
                    'error' => 'vehicle income  with ID ' . $id . ' not found.'
                ], 404);

            }

            $validated_payload_data = $request->validate([
                'hours_worked' => 'numeric',
                'hourly_rate' => 'numeric',
            ]);


            $income->update($validated_payload_data);

            return response()->json(['message' => 'vehicle income updated Successfully With ID: ' . $income->id, 'data' => $income ], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }

    public  function  delete($id)
    {

        $income = VehicleIncome::find($id);

        if (!$income){
            return response()->json([
                'status' => 404,
                'error' => 'vehicle income  with ID ' . $id . ' not found.'
            ], 404);

        }
        $income->delete();
        return response()->json(['message' => 'vehicle income  deleted Successfully '], 200);

    }

}
