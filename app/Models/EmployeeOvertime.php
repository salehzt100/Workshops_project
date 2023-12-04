<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOvertime extends Model
{
    use HasFactory;
    protected $fillable = ['employeeFinancialType', 'user_id', 'date', 'hours_worked', 'rate_per_hour', 'amount'];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id');
    }
}
