<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'payment_type', 'amount_type', 'check_id', 'employee_overtime_id', 'employee_id', 'gas_station_id', 'expense_id', 'vehicle_income_id', 'vehicle_id', 'workshop_id', 'note', 'timestamp'];


    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }


    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function employeeOvertime(): BelongsTo
    {
        return $this->belongsTo(EmployeeOvertime::class, 'employee_overtime_id');
    }


    public function check(): BelongsTo
    {
        return $this->belongsTo(checks::class);
    }

    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    public function vehicleIncome(): BelongsTo
    {
        return $this->belongsTo(VehicleIncome::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    //NOTE: there is no more need for this, as the payment will be to a workshop according to the desired amount
    public function workshopFinancialProcess(): BelongsTo
    {
        return $this->belongsTo(WorkshopFinancialProcess::class);
    }
}
