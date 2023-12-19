<?php

namespace App\Http\Controllers\v1;
use App\Models\Owner;
use App\Models\WorkshopFinancialProcess;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Collection;

class WorkshopFinancialProcessController extends Controller
{


//        Schema::create( 'workshop_financial_processes', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('workshop_id');
//            $table->decimal('price_per_hour_and_cup', 10, 2)->nullable();
//            $table->decimal('rate_per_hour_and_cup', 10, 2)->nullable();
//            $table->decimal('total_amount', 10, 2);
//            $table->timestamps();




    public function index(Request $request)
    {
        $current_page = $request->input('page', 1);
        $limit = $request->input('limit', 2);

        $selected1 = ['id', 'payment_type', 'total_amount', 'created_at'];
        $selected2 = ['id', 'payment_type', 'total_amount', 'price_per_hour_and_cup', 'rate_per_hour_and_cup', 'created_at'];

        $financial1 = WorkshopFinancialProcess::query()
            ->select($selected1)
            ->where('payment_type', '=', 'ContractPayment')
            ->paginate($limit, $selected1, "page", $current_page)
            ->items();

        $financial2 = WorkshopFinancialProcess::query()
            ->select($selected2)
            ->where('payment_type', '!=', 'ContractPayment')
            ->paginate($limit, $selected2, "page", $current_page)
            ->items();

        $financial = array_merge($financial1,$financial2);
        $financial = collect($financial)->sortByDesc('created_at')->values();


        return ['data' => $financial];
    }



    public function show($id)
    {
        $financial = WorkshopFinancialProcess::find($id);
        $selected=[];
        if ($financial->payment_type === 'ContractPayment'){
            $selected1 = ['id', 'payment_type', 'total_amount', 'created_at'];

            $workshop_financial=[
                'id'=> $financial['id'],
                'payment_type'=>$financial['payment_type'],
                'total_amount'=>$financial['total_amount'],
                'workshop_id'=>$financial['workshop_id'],
                'created_at'=>$financial['created_at']
            ];

            return ['data' => $workshop_financial];

        }else{

            $workshop_financial=[
                'id'=> $financial['id'],
                'payment_type'=>$financial['payment_type'],
                'total_amount'=>$financial['total_amount'],
                'workshop_id'=>$financial['workshop_id'],
                'price_per_hour_and_cup'=>$financial['price_per_hour_and_cup'],
                'rate_per_hour_and_cup'=>$financial['rate_per_hour_and_cup'],
                'created_at'=>$financial['created_at']
            ];
            return ['data' => $workshop_financial];
        }

    }

    public function update(Request $request, $id)
    {
        try {

            $financial = WorkshopFinancialProcess::find($id);

            if (!$financial) {
                return response()->json([
                    'status' => 404,
                    'error' => 'Workshop financial with ID ' . $id . ' not found.'
                ], 404);
            }



            $validated_payload_data=$request->validate([
                'price_per_hour_and_cup'=>'numeric',
                'rate_per_hour_and_cup'=>'numeric'
            ]);
            $request_price = $request->filled('price_per_hour_and_cup') ? $validated_payload_data['price_per_hour_and_cup'] : $financial->price_per_hour_and_cup;
            $request_rate = $request->filled('rate_per_hour_and_cup') ? $validated_payload_data['rate_per_hour_and_cup'] : $financial->rate_per_hour_and_cup;   $total_amount = $request_rate * $request_price;
            $validated_payload_data['total_amount'] = $total_amount;

            $financial->update($validated_payload_data);

            return response()->json(['message' => 'Workshop financial updated successfully with ID: ' . $financial->id, 'data' => $financial], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }

    public function delete($id)
    {
        $financial = WorkshopFinancialProcess::find($id);

        if (!$financial) {
            return response()->json([
                'status' => 404,
                'error' => 'Workshop financial with ID ' . $id . ' not found.'
            ], 404);
        }

        $financial->delete();
        return response()->json(['message' => 'Workshop financial deleted successfully'], 200);
    }

}
