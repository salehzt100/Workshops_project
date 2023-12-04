<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshops extends Model
{
    use HasFactory;
    protected $fillable = ['owner_id', 'name', 'workshop_type', 'total_payments', 'cash_payments', 'check_payments', 'remaining_balance'];
    public function owner()
    {
        return $this->belongsTo(Owners::class, 'owner_id');
    }

    public function workshopPaymentType()
    {
        return $this->belongsTo(workshopPaymentTypes::class, 'paymentTypeId');
    }

    public function vehicles()
    {
        return $this->hasManyThrough(Vehicles::class, WorkshopVehicles::class, 'workshop_id', 'id', 'id', 'vehicle_id');
    }
}
