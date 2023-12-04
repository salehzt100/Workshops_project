<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopFinancialProcess extends Model
{
    use HasFactory;
    protected $fillable = ['workshop_id', 'countOfCupsOrHours', 'ratePerCupOrHour', 'totalAmount'];
    public function workshop()
    {
        return $this->belongsTo(Workshops::class, 'workshop_id');
    }
}
