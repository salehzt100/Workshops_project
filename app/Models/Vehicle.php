<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_name', 'full_vehicles_price', 'vehicle_type', 'vehicles_number_or_identifier', 'sale_status', 'sale_price'];

    public function workshops()
    {
        return $this->belongsToMany('workshops', 'vehicle_workshops');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'vehicle_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, "vehicle_id");
    }


    protected $appends = ['total_amount_paid_so_far', 'amount_paid_in_cash', 'amount_paid_by_checks', 'remaining_amount', 'status'];

    public function getTotalAmountPaidSoFarAttribute()
    {

        $total_amount_paid_so_far = $this->getAmountPaidInCashAttribute() + $this->getAmountPaidByChecksAttribute();
        return $total_amount_paid_so_far;
    }

    public function getAmountPaidInCashAttribute()
    {
        $amount_paid_in_cash = 0;
        $payments = $this->payments()
            ->where('payment_type', 'vehicleCost')
            ->where('amount_type', 'cash')
            ->get();

        foreach ($payments as $payment) {
            $amount_paid_in_cash += $payment->amount;
        }

        return $amount_paid_in_cash;
    }

    public function getAmountPaidByChecksAttribute()
    {
        $amount_paid_by_checks = 0;
        $payments = $this->payments()
            ->where('payment_type', 'vehicleCost')
            ->where('amount_type', 'check')
            ->get();

        foreach ($payments as $payment) {
            $amount_paid_by_checks += $payment->amount;
        }

        return $amount_paid_by_checks;
    }

    public function getRemainingAmountAttribute()
    {
        $remaining_amount = $this->full_vehicles_price - $this->getTotalAmountPaidSoFarAttribute();
        return $remaining_amount;
    }


    public function getStatusAttribute()
    {
        $vehicleWorkshops = VehicleWorkshops::where('vehicle_id', $this->id)->get();

        if ($vehicleWorkshops->isEmpty()) {
            return 'not working';
        }

        return 'working';
    }
}
