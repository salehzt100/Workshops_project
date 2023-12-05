<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['name', 'national_id', 'phone', 'salary', 'total_advances'];


    public function overtime(): HasMany
    {
        return $this->hasMany(EmployeeOvertime::class, 'employee_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'employee_id');
    }
}
