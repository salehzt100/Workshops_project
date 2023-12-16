<?php

declare(strict_types=1);
namespace App\Http\Controllers\v1;


use App\Models\checks;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;

class CheckController extends Controller
{

    public function index(Request $request)
    {


        $current_page = $request->input('page', 1);
        $limit = $request->input('limit', 2);


        $checks = checks::query()
            ->paginate($limit, ['id', 'amount', 'dueDate', 'owner'], "page", $current_page)
            ->items();

        return ['data' => $checks];
    }

    public function show($id){
        $check = checks::find($id);

        if (!$check){
            return response()->json([
                'status' => 404,
                'error' => 'check with ID ' . $id . ' not found.'
            ], 404);

        }
        return ['data' => $check];
    }



    public function add(Request $request)
    {
        try {
            $validated_payload_data = $request->validate([
                'owner' => 'required|string|max:255',
                'amount' => 'required|numeric',
                'dueDate' => 'required|date'
            ]);

            if (strtotime($validated_payload_data['dueDate']) < now()->timestamp) {
                return response()->json(['error' => 'Please enter a valid date for this check.'], 200);
            }

            $check = new checks($validated_payload_data);
            $check->save();

            return response()->json(['message' => 'Check created successfully with ID: ' . $check->id, 'data' => $check], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }


}
