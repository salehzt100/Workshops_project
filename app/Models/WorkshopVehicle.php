<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopVehicles extends Model
{
    use HasFactory;
    protected $fillable = ['workshop_id', 'vehicle_id'];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function vehicleIncome()
    {
        return $this->hasMany(VehicleIncome::class);
    }
}
