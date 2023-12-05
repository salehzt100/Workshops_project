<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopFinancialProcess extends Model
{
    use HasFactory;
    protected $fillable = ['workshop_id',  'count_of_hours_or_cups', 'rate_per_hour_or_cup', 'total_amount'];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'workshop_financial_process_id');
    }
    /**
     * Table WorkshopFinancialProcess {
  id int [primary key]
  workshop_id int
 count_of_hours_or_cups decimal(5,2)
  rate_per_hour_or_cup decimal(10,2)
  total_amount decimal(10,2)

}
     */
}
