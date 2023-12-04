<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owners extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone_number'];

    public function gasStations()
    {
        return $this->hasMany(GasStation::class, 'owner_id');
    }

    public function workshops()
    {
        return $this->hasMany(Workshops::class, 'owner_id');
    }
}
