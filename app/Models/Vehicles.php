<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;
    protected $fillable = ['vehicles_name', 'full_vehicles_price', 'vehicle_type', 'vehicles_number_or_identifier', 'total_amount_paid_so_far', 'amount_paid_in_cash', 'amount_paid_by_checks', 'remaining_amount', 'sale_status', 'sale_price'];
}
