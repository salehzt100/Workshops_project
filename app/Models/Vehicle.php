<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'purchased_price', 'type', 'number_or_identifier', 'total_amount_paid_so_far', 'amount_paid_cash', 'amount_paid_checks', 'remaining_amount', 'sale_status', 'sale_price'];

    public function workshops(): BelongsToMany
    {
        return $this->belongsToMany(Workshop::class, 'WorkshopVehicles')->withPivot('id');
    }
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'vehicle_id');
    }
}

/**
 *
Table Vehicles {
  id int [primary key]
  name varchar(255)
  purchased_price decimal(10, 2)
  type varchar(255)
  number_or_identifier varchar(50)
  total_amount_paid_so_far decimal(10, 2)
  amount_paid_cash decimal(10, 2)
  amount_paid_checks decimal(10, 2)
 remaining_amount decimal(10, 2)
  sale_status varchar(50)
  sale_price decimal(10, 2)
}
 */
