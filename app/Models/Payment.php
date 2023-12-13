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

    protected $fillable = ['amount', 'amount_type', 'check_id', 'employee_overtime_id', 'employee_id', 'gas_station_refill_id', 'expense_id', 'vehicle_income_id', 'workshop_id', 'note'];


    public function workshops(){
        return $this->belongsTo(Workshop::class);
    }


  public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function employeeOvertime(): BelongsTo
    {
        return $this->belongsTo(EmployeeOvertime::class, 'employee_overtime_id');
    }


    public function check(): HasOne
    {
        return $this->hasOne(checks::class);
    }
/*
    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    public function vehicleIncome(): BelongsTo
    {
        return $this->belongsTo(VehicleIncome::class);
    }

    public function workshopFinancialProcess(): BelongsTo
    {
        return $this->belongsTo(WorkshopFinancialProcess::class);
    }
*/
}