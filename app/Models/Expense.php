<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['expense_type', 'amount', 'date', 'vehicle_id', 'gas_station_id', 'workshop_id', 'workshop_vehicle_id', 'person_name', 'notes'];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function workshop(): BelongsTo
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }

    public function gasStation(): BelongsTo
    {
        return $this->belongsTo(GasStation::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'expense_id');
    }
}

/**
 *
 * ddl
 * Table Expenses {
expense_type enum (operational, fuel_with_draw, fuel_cash, maintenance, lubrication)
id int [primary key]
amount int
date date
vehicle_id int
gas_station_id int
workshop_id int
workshop_vehicle_id int
person_name varchar(255)
notes varchar(255)
}
 */
