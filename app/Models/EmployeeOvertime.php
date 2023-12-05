<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeOvertime extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['employee_id', 'date', 'hours_worked', 'rate_per_hour', 'amount'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'employee_overtime_id', 'id');
    }
}
