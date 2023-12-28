<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleIncome extends Model
{
    use HasFactory;
    protected $fillable = ['vehicle_workshop_id', 'hours_worked','hourly_rate'];

    public function workshopVehicle()
    {
        return $this->belongsTo(VehicleWorkshops::class, 'vehicle_workshops_id');
    }

    protected $appends =['income'];

    public function getIncomeAttribute(){

        $hours_worked=$this->hours_worked;
        $hourly_rate=$this->hourly_rate;
        return $hours_worked*$hourly_rate;
    }
}
