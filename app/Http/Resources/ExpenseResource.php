<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'person_name' => $this->person_name,
            'amount' => $this->amount,
            'gas_station_id' => $this->gas_station_id,
            'date' => $this->date,
            'notes' => $this->notes,
            'workshop_id' => $this->workshop_id,
            'machine_id' => $this->machine_id,
        ];
    }
}
