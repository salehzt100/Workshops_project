<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workshopsPaymentTypes extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'countOfCupsOrCups', 'ratePerCupOrHour', 'total'];

    public function workshops()
    {
        return $this->hasMany(Workshops::class, 'paymentTypeId');
    }
}
