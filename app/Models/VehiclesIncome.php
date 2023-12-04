<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiclesIncome extends Model
{
    use HasFactory;
    protected $fillable = ['WorkshopVehicles_id', 'hours_worked', 'income', 'date'];

    public function workshopVehicle()
    {
        return $this->belongsTo(WorkshopVehicles::class, 'WorkshopVehicles_id');
    }
}
