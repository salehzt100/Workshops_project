<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $fillable = ['expense_type', 'amount', 'date', 'vehicle_id', 'station_id', 'workshop_id', 'workshop_vehicle_id', 'person_name', 'notes'];
}
