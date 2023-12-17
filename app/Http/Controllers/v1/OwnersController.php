<?php

namespace App\Http\Controllers\v1;
use App\Models\Owner;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OwnersController extends Controller
{

    public function index(Request $request)
    {

        $current_page = $request->input('page', 1);
        $limit = $request->input('limit', 2);

        $vehicles = Owner::query()
            ->paginate($limit, ['id', 'name', 'phone', 'created_at'], "page", $current_page)
            ->items();

        return ['data' => $vehicles];
    }
    public function show($id)
    {
        $owner = Owner::find($id);

        if (!$owner){
            return response()->json([
                'status' => 404,
                'error' => 'owner with ID ' . $id . ' not found.'
            ], 404);

        }
        return ['data' => $owner];
    }


    public function add(Request $request)
    {
        try {
            $validated_payload_data = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|numeric|digits:10',
            ]);

            $owner = Owner::create($validated_payload_data);

            return response()->json([
                'message' => 'Owner created successfully with ID: ' . $owner->id,
                'data' => $owner,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }




    public function update(Request $request,$id){

        try {
            $owner=Owner::find($id);

            if (!$owner){
                return response()->json([
                    'status' => 404,
                    'error' => 'vehicle with ID ' . $id . ' not found.'
                ], 404);

            }


            $validated_payload_data=$request->validate([
                'name' =>'string|max:255',
                'phone'=>'numeric|size:10'
            ]);

            $owner->update($validated_payload_data);

            return response()->json(['message' => 'owner updated Successfully With ID: ' . $owner->id, 'data' => $owner], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }


    public  function  delete($id)
    {

        $owner=Owner::find($id);

        if (!$owner){
            return response()->json([
                'status' => 404,
                'error' => 'owner with ID ' . $id . ' not found.'
            ], 404);

        }

        $owner->delete();
        return response()->json(['message' => 'owner deleted Successfully '], 200);

    }





}
