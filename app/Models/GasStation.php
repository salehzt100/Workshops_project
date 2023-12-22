<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GasStation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['name', 'owner_id', 'current_balance'];



    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'gas_station_id');
    }
}
