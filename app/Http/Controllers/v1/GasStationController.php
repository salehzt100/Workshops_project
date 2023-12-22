<?php

namespace App\Http\Controllers\v1;

use App\Http\Resources\GasStationResource; // Make sure this is the correct namespace
use App\Models\GasStation;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class GasStationController extends Controller
{
    public function index()
    {
        $gasStations = GasStation::paginate(10); // 10 is the number of items per page
        return GasStationResource::collection($gasStations);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'owner_id' => 'required|integer',
            'current_balance' => 'required|numeric|min:0',
        ]);

        $gasStation = GasStation::create($validatedData);

        return new GasStationResource($gasStation);
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'max:255',
            'owner_id' => 'integer',
            'current_balance' => 'numeric|min:0',
        ]);

        $gasStation = GasStation::findOrFail($id);
        $gasStation->update($validatedData);

        return new GasStationResource($gasStation);
    }
    public function destroy($id)
    {
        $gasStation = GasStation::findOrFail($id);

        if ($gasStation->current_balance > 0) {
            return response()->json(['error' => 'Cannot delete gas station with a positive balance'], 400);
        }

        $gasStation->delete();

        return response()->json(null, 204);
    }

    public function addBalance(Request $request, $id)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $gasStation = GasStation::findOrFail($id);
        $gasStation->current_balance += $validatedData['amount'];
        $gasStation->save();

        return new GasStationResource($gasStation);
    }
}
