<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopFinancialProcess extends Model
{
    use HasFactory;

    protected $fillable = ['workshop_id', 'rate_per_hour_and_cup', 'price_per_hour_and_cup', 'total_amount'];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'workshop_financial_process_id');
    }
}
