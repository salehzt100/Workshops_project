<?php
declare(strict_types=1);

namespace App\Http\Controllers\v1;

use App\Models\checks;
use App\Models\Owner;
use App\Models\Payment;
use App\Models\Vehicle;
use App\Models\Workshop;
use App\Models\VehicleWorkshops;
use App\Models\WorkshopFinancialProcess;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PHPUnit\Exception;


class WorkshopsController extends Controller
{

    public function index(Request $request)

    {
        try {


            $current_page = $request->input('page', 1);
            $limit = $request->input('limit', 2);

            $workshops = Workshop::query()
                ->with('owner:id,name,phone')
                ->select(['id', 'workshop_name', 'workshop_type', 'status', 'count_employees', 'owner_id'])
                ->paginate($limit, ['*'], 'page', $current_page)
                ->items();

            return response()->json([
                'status' => 20,
                'data' => $workshops

            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()


            ], 303);

        }
    }

    public function show($id)
    {
        $workshop = Workshop::select(['id', 'workshop_name', 'workshop_type', 'status', 'count_employees', 'created_at', 'owner_id', 'remaining_balance'])
            ->find($id);

        if (!$workshop) {
            return response()->json([
                'status' => 404,
                'error' => 'workshop With ID: ' . $id . ' not font'
            ], 404);
        }

        $workshop->load([
            'owner:id,name,phone',
            'workshopFinancialProcess' => function ($query) use ($workshop) {
                if ($workshop->workshop_type == 'transportation' or $workshop->workshop_type == 'sellingAggregate') {
                    $query->select(['id', 'workshop_id', 'price_per_hour_and_cup', 'rate_per_hour_and_cup', 'total_amount']);
                } elseif ($workshop->workshop_type === 'workshop') {
                    $query->select(['id', 'workshop_id', 'total_amount']);
                }
            },
        ]);

        return response()->json([
            'status' => 200,
            'data' => $workshop
        ], 200);
    }

    public function add(Request $request)
    {
        try {
            $validated_payload_data = $request->validate([
                'owner_id' => 'required|numeric',
                'workshop_name' => 'required|string|max:255',
                'workshop_type' => 'required|in:sellingAggregate,transportation,workshop',
                'count_employees' => 'required|numeric'
            ]);

            $owner = Owner::find($request->owner_id);

            if (!$owner) {
                return response()->json([
                    'status' => 404,
                    'error' => 'owner with ID ' . $request->id . 'not found.'
                ], 404);
            }


            $workshop = Workshop::create($validated_payload_data);

            return response()->json([
                'message' => 'Workshop Created Successfully With ID: ' . $workshop->id,
                'data' => $workshop
            ], 200);

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }

    public function update(Request $request, $id)

    {

        try {


            $workshop = Workshop::find($id);
            if (!$workshop) {
                return response()->json([
                    'status' => 404,
                    'error' => 'workshop with ID ' . $request->id . 'not found.'
                ], 404);
            }

            $validated_payload_data = $request->validate([
                'owner_id' => 'numeric',
                'workshop_name' => 'string|max:255',
                'workshop_type' => 'in:sellingAggregate,transportation,workshop',
                'count_employees' => 'numeric'
            ]);

            if ($request->owner_id) {
                $owner = Owner::find($request->owner_id);

                if (!$owner) {
                    return response()->json([
                        'status' => 404,
                        'error' => 'owner with ID  ' . $request->owner_id . ' not found.'
                    ], 404);
                }
            }

            $updated_workshop = $workshop->update($validated_payload_data);

            return response()->json([
                'message' => 'Workshop updated Successfully With ID: ' . $id,
                'data' => $workshop
            ], 200);

        } catch (ValidationException $e) {

            response()->json(['error' => $e->validator->errors()], 422);
        }

    }

    /**  is this function we use to delete all data related  with specific workshop or jus date delete from workshop table*/

    public function delete($id)
    {

        $workshop = Workshop::find($id);
        if (!$workshop) {
            return response()->json([
                'status' => 404,
                'error' => 'workshop with ID ' . $id . ' not found.'
            ], 404);
        }

        $workshop->delete();

        return response()->json([
            'message' => 'Workshop deleted Successfully With ID: ' . $id,
        ], 200);
    }

    public function getPayments($id)
    {

        $workshop = Workshop::find($id);

        if (!$workshop) {
            return response()->json([
                'status' => 404,
                'error' => 'workshop with ID ' . $id . ' not found.'
            ], 404);
        }

        $payments_data = $workshop->payments;


        if (sizeof($payments_data) == 0) {
            return response()->json([
                'status' => 404,
                'error' => 'payments for workshop with ID ' . $id . ' not found.'
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


            $workshop = Workshop::find($id);

            if (!$workshop) {
                return response()->json([
                    'status' => 404,
                    'error' => 'workshop with ID ' . $id . ' not found.'
                ], 404);
            }

            $validated_data = $request->validate([
                'amount_type' => 'required|in:check,cash',
                'amount' => 'required_if:amount_type,cash|numeric',
                'note' => 'string',
                'check_id' => 'required_if:amount_type,check|unique:payments,check_id'
            ]);


            if ($request->amount_type === 'check') {
                $check = checks::find($request->check_id);

                if (!$check) {
                    return response()->json([
                        'status' => 404,
                        'error' => 'check with ID ' . $request->check_id . ' not found.'
                    ], 404);
                }


                if ($check->amount > $workshop->remaining_balance) {
                    return response()->json([
                        'error' => 'the payments amount [ ' . $check->amount . ' ] exceeded the desired amount [ ' . $workshop->remaining_balance . ' ].',
                    ], 422);

                }

            } else {

                if ($request->amount > $workshop->remaining_balance) {

                    return response()->json([
                        'error' => 'the payments amount [ ' . $request->amount . ' ] exceeded the desired amount [ ' . $workshop->remaining_balance . ' ].',
                    ], 422);
                }
            }


            $validated_data['workshop_id'] = $id;
            $workshop_payment = Payment::create($validated_data);


            return response()->json([
                'message' => 'payments added Successfully With ID: ' . $workshop_payment->id . ' to workshop With ID ' . $id,
                'data' => $workshop_payment
            ], 200);


        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()]);

        }
    }

    public function getVehicles($id)
    {

        $workshop = Workshop::find($id);

        if (!$workshop) {

            return response()->json(['error' => 'Workshop not found With ID ' . $id], 404);
        }
        $vehicles = $workshop->vehicles->map(function ($vehicle) {

            return [
                'id' => $vehicle->id,
                'vehicle_name' => $vehicle->vehicle_name,
                'vehicle_type' => $vehicle->vehicle_type,
                'vehicles_number_or_identifier' => $vehicle->vehicles_number_or_identifier,
            ];
        });


        return response()->json([
            'data' => $vehicles
        ], 200);


    }

    public function setVehicles(Request $request)
    {
        $workshop = Workshop::find($request->workshop_id);

        if (!$workshop) {
            return response()->json([
                'status' => 404,
                'error' => 'workshop with ID ' . $request->workshop_id . ' not found.'
            ], 404);
        }

        $vehicle = Vehicle::find($request->vehicle_id);

        if (!$vehicle) {
            return response()->json([
                'status' => 404,
                'error' => 'vehicle with ID ' . $request->vehicle_id . ' not found.'
            ], 404);
        }

        $check_found = VehicleWorkshops::where('vehicle_id', $request->vehicle_id)->first();

        if ($check_found) {
            return response()->json([
                'error' => 'vehicle with ID ' . $request->vehicle_id . ' is working within workshop has ID ' . $check_found->workshop_id
            ], 409);

        }

        $vehicle_workshop = VehicleWorkshops::create([
            'workshop_id' => $request->workshop_id,
            'vehicle_id' => $request->vehicle_id
        ]);

        return response()->json([
            'message' => 'vehicle With ID: ' . $request->vehicle_id . ' added Successfully to workshop With ID ' . $request->workshop_id,
            'data' => $vehicle_workshop
        ], 200);
    }


    public function setWorkshopFinancial()
    {

        return 'set function';
    }
}
