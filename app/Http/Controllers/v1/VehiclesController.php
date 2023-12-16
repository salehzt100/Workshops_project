<?php

namespace App\Http\Controllers\v1;

use App\Models\checks;
use App\Models\Payment;
use App\Models\Vehicle;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VehiclesController extends Controller
{
    public function index(Request $request)
    {


        $current_page = $request->input('page', 1);
        $limit = $request->input('limit', 2);


        $vehicles = Vehicle::query()
            ->paginate($limit, ['id', 'vehicle_name', 'vehicle_type', 'full_vehicles_price', 'remaining_amount'], "page", $current_page)
            ->items();

        return ['data' => $vehicles];
    }

    public function show($id){
        $vehicle = Vehicle::find($id);

        if (!$vehicle){
                return response()->json([
                    'status' => 404,
                    'error' => 'vehicle with ID ' . $id . ' not found.'
                ], 404);

        }
        return ['data' => $vehicle];
    }

    public function add(Request $request){
        try {
            $validated_payload_data=$request->validate([
            'vehicle_name' =>'required|string|max:255',
            'full_vehicles_price'=>'required|numeric',
            'vehicle_type'=>"required|string",
            'vehicles_number_or_identifier'=>'required|string',
            'sale_price'=>'numeric'
        ]);

            $vehicle = Vehicle::create($validated_payload_data);
            $vehicle->save();

            return response()->json(['message' => 'Vehicle Created Successfully With ID: ' . $vehicle->id, 'data' => $vehicle], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }

    }


public function update(Request $request,$id){

    try {
        $vehicle=Vehicle::find($id);

        if (!$vehicle){
            return response()->json([
                'status' => 404,
                'error' => 'vehicle with ID ' . $id . ' not found.'
            ], 404);

        }


        $validated_payload_data=$request->validate([
            'vehicle_name' =>'string|max:255',
            'full_vehicles_price'=>'numeric',
            'vehicle_type'=>"required|string",
            'vehicles_number_or_identifier'=>'string',
            'sale_price'=>'numeric'
        ]);

        $vehicle->update($validated_payload_data);

        return response()->json(['message' => 'Vehicle updated Successfully With ID: ' . $vehicle->id, 'data' => $vehicle], 200);
    } catch (ValidationException $e) {
        return response()->json(['error' => $e->validator->errors()], 422);
    }
}


public  function  delete($id)
{

    $vehicle=Vehicle::find($id);

    if (!$vehicle){
        return response()->json([
            'status' => 404,
            'error' => 'vehicle with ID ' . $id . ' not found.'
        ], 404);

    }

    $vehicle->delete();
    return response()->json(['message' => 'Vehicle deleted Successfully '], 200);

}





    public function getPayments($id)
    {

        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'status' => 404,
                'error' => 'vehicle with ID ' . $id . ' not found.'
            ], 404);
        }

        $payments_data = $vehicle->payments()->where('payment_type','vehicleCost')->get();

        if (sizeof($payments_data) == 0) {
            return response()->json([
                'status' => 404,
                'error' => 'payments for vehicle with ID ' . $id . ' not found.'
            ], 404);
        }

        $payments = $payments_data->map(function ($payment) {

            return collect([
                'id' => $payment->id,
                'amount_type' => $payment->amount_type,
                'amount' => $payment->amount,
                'note' => $payment->note,
                'date' => $payment->created_at
            ])->when($payment->amount_type === 'check', function ($collection) use ($payment) {
                return $collection->merge(['check_id' => $payment->check_id]);
            });
            return $collection;
        });

        return response()->json([
            'data' => $payments
        ], 200);

    }

    public function setPayments(Request $request, $id)
    {
        try {
            $vehicle = Vehicle::find($id);

            if (!$vehicle) {
                return response()->json([
                    'status' => 404,
                    'error' => 'Vehicle with ID ' . $id . ' not found.'
                ], 404);
            }

            $validated_data = $request->validate([
                'amount_type' => 'required|in:check,cash',
                'amount' => 'required_if:amount_type,cash|numeric',
                'note' => 'string',
                'check_id' => 'required_if:amount_type,check|unique:payments,check_id'
            ]);



            if ($request->amount_type == 'check') {
                $check = checks::find($request->check_id);

                if (!$check) {
                    return response()->json([
                        'status' => 404,
                        'error' => 'Check with ID ' . $request->check_id . ' not found.'
                    ], 404);
                }

                if ($check->amount > $vehicle->remaining_amount) {
                    return response()->json([
                        'error' => 'The payment amount [' . $check->amount . '] exceeded the remaining amount [' . $vehicle->remaining_amount . '].',
                    ], 422);
                }

                $validated_data['amount']=$check->amount;


            } else {
                if ($request->amount > $vehicle->remaining_amount) {
                    return response()->json([
                        'error' => 'The payment amount [' . $request->amount . '] exceeded the remaining amount [' . $vehicle->remaining_amount . '].',
                    ], 422);
                }
            }

            if ($validated_data['amount_type']=='cash'){
                $validated_data['check_id']=null;
            }

            $validated_data['payment_type'] = 'vehicleCost';
            $validated_data['vehicle_id'] = $id;

            $vehicle_payment = Payment::create($validated_data);

            return response()->json([
                'message' => 'Payments added successfully with ID: ' . $vehicle_payment->id . ' to vehicle with ID ' . $id,
                'data' => $vehicle_payment
            ], 200);

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()]);
        }
    }



}
