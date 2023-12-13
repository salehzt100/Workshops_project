<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleWorkshop extends Model
{
    use HasFactory;
    protected $fillable = ['workshop_id', 'vehicle_id'];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function vehicleIncome()
    {
        return $this->hasMany(VehicleIncome::class);
    }
}
