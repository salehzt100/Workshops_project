<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone'];

    public function gasStations(): HasMany
    {
        return $this->hasMany(GasStation::class, 'owner_id');
    }

    public function workshops(): HasMany
    {
        return $this->hasMany(Workshop::class,'owner_id');
    }
}
