<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $fillable = ['payment_type', 'amount_type', 'check_id', 'date', 'employee_overtime_id', 'employee_id', 'station_refill_id', 'expenses_id', 'vehicle_income_id', 'workshop_financial_process_id', 'note'];
}
