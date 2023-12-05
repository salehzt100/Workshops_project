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
    protected $fillable = ['name', 'owner_id', 'Workshop_id', 'current_balance'];

    public function refills(): HasMany
    {
        return $this->hasMany(GasStationRefill::class, 'gas_station_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'gas_station_id');
    }

    // public function workshop()
    // {
    //     return $this->belongsTo(Workshops::class, 'Workshop_id');
    // }
}


/**
 *
 * ddl
 * Table GasStation {
  id int [primary key]
  name varchar(255)
  owner_id int
  Workshop_id int
  current_balance decimal(10, 2)
}
 */
