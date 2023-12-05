<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workshop extends Model
{
    use HasFactory;
    protected $fillable = ['owner_id', 'name', 'payment_type', 'type', 'desired_amount', 'cash_payments', 'check_payments', 'remaining_balance'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }
    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class, 'WorkshopVehicles')->wherePivot('id');
    }
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function financialProcesses(): HasMany
    {
        return $this->hasMany(WorkshopFinancialProcess::class);
    }
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'workshop_id');
    }
}

/**
 * Table Workshops {
  id int [primary key]
  owner_id int
  name varchar(255)
  payment_type enum(housr, contract, cups )
  type enum (workshop, sand, transportaion)
  desired_amount decimal(10,2)
  cash_payments decimal(10, 2)
  check_payments decimal(10, 2)
  remaining_balance decimal(10, 2)

}
 */
