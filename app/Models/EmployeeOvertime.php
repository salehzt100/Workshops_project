<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeOvertime extends Model
{
    use HasFactory;


    protected $fillable=['employee_financial_type','hours_worked','rate_per_hour','amount','employee_id'];

    public  function employee(){
        return $this->belongsTo('employee');
    }


    public function payments()
    {
        return $this->hasMany(Payment::class, 'employee_overtime_id');
    }
}
