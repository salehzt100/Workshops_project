<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workshopsPaymentTypes extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'count_per_cup_or_hour', 'rate_per_cup_or_hour', 'total'];

    public function workshops()
    {
        return $this->hasMany(Workshops::class, 'paymentTypeId');
    }
}
