<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'workshop_name', 'workshop_type'];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function workshopVehicle()
    {
        return $this->hasMany(VehicleWorkshop::class, 'workshop_id');
    }

    public function payments()
    {
        return $this->HasMany(Payment::class, 'workshop_id');
    }

    public function workshopFinancialProcess()
    {
        return $this->hasMany(WorkshopFinancialProcess::class, 'workshop_id');
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }

    protected $appends = ['count_vehicle', 'total_amount', 'total_cash_payments', 'total_check_payments', 'remaining_balance'];


    public function getRemainingBalanceAttribute()
    {

        return $this->total_amount - ($this->total_cash_payments + $this->total_check_payments);
    }

    public function getTotalCashPaymentsAttribute()
    {
        $total_cash = 0;

        $payments = $this->hasMany(Payment::class, 'workshop_id')->where('amount_type', 'cash')->get();

        if ($payments->count() > 0) {
            foreach ($payments as $payment) {
                $total_cash += $payment->amount;
            }
        }

        return $total_cash;
    }

    public function getTotalCheckPaymentsAttribute()
    {
        $total_check = 0;

        $payments = $this->hasMany(Payment::class, 'workshop_id')->where('amount_type', 'check')->get();

        if ($payments->count() > 0) {
            foreach ($payments as $payment) {
                $total_check += $payment->amount;
            }
        }

        return $total_check;
    }

    public function getCountVehicleAttribute()
    {
        $count_vehicle = $this->vehicles()->count();
        return $count_vehicle;
    }

    public function getTotalAmountAttribute()
    {
        $total_amount = 0;

        $financials = $this->workshopFinancialProcess;

        if ($financials->count() > 0) {
            foreach ($financials as $financial) {
                $total_amount += $financial->total_amount;
            }
        }
        return $total_amount;
    }
}
