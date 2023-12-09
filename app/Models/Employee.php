<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'national_id', 'phone', 'status', 'national_id', 'salary', 'total_advances'];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'employee_id');
    }
    public function overtimes(): HasMany
    {
        return $this->hasMany(EmployeeOvertime::class, 'employee_id');
    }


    protected $appends = ['total_overtime_hour', 'last_overtime_hour', 'overtime_and_award_collections'];

    public function getTotalOvertimeHourAttribute()
    {

        $total_overtime_hour = 0;

        $overtimes = $this->overtimes()
            ->where('employee_id', $this->id)
            ->where('employee_financial_type', 'overtime')
            ->get();

        foreach ($overtimes as $overtime) {
            $total_overtime_hour += $overtime['hours_worked'];
        }

        return $total_overtime_hour;
    }

    public function getLastOvertimeHourAttribute()
    {

        $last_overtime_hour = 0;


        $overtime = $this->overtimes()
            ->orderByDesc('created_at')
            ->where('employee_id', $this->id)
            ->where('employee_financial_type', 'overtime')
            ->first();

        if ($overtime) {
            $last_overtime_hour = $overtime->hours_worked;
        }
        return $last_overtime_hour;
    }

    public function getOvertimeAndAwardCollectionsAttribute()
    {

        $overtime_and_award_collections = 0;

        $overtimes = $this->overtimes()
            ->where('employee_id', $this->id)
            ->get();

        if ($overtimes) {
            foreach ($overtimes as $overtime) {

                $overtime_and_award_collections += $overtime->amount;
            }
        }

        return $overtime_and_award_collections;

    }


}
