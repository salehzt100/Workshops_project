<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Check extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'dueDate', 'owner'];

    public function payment(): BelongsTo
    {

        return $this->belongsTo(Payment::class);
    }
}
