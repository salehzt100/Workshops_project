<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasStationRefill extends Model
{
    use HasFactory;
    protected $fillable = ['GasStation_id', 'transaction_date', 'amount', 'notes'];
    public function gasStation()
    {
        return $this->belongsTo(GasStation::class, 'GasStation_id');
    }
}
