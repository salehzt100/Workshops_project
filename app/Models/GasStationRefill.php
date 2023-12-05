<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GasStationRefill extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $guarded = ['id'];
    protected $fillable = ['gas_station_id', 'transaction_date', 'total_amount', 'notes'];
    public function gasStation(): BelongsTo
    {
        return $this->belongsTo(GasStation::class, 'gas_station_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'gas_station_refill_id');
=======
    protected $fillable = ['gas_station_id', 'transaction_date', 'amount', 'notes'];
    public function gasStation()
    {
        return $this->belongsTo(GasStation::class, 'gas_station_id');
>>>>>>> 0c6ec9e754c516740a5556bb954a12012f3aa96b
    }
}

/**
 * ddl
 * Table GasStationRefill {
  id int [primary key]
  gas_station_id int
  transaction_date date
  total_amount decimal(10, 2)
  notes varchar(255)
}
 */
