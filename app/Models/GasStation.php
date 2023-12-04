<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasStation extends Model
{
    use HasFactory;
    protected $fillable = ['Name', 'owner_id', 'Workshop_id', 'current_balance'];

    public function refills()
    {
        return $this->hasMany(GasStationRefill::class, 'GasStation_id');
    }

    public function owner()
    {
        return $this->belongsTo(Owners::class, 'owner_id');
    }

    public function workshop()
    {
        return $this->belongsTo(Workshops::class, 'Workshop_id');
    }
}
