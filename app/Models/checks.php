<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class checks extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'dueDate', 'owner'];

    public function payment(): HasOne
    {

        return $this->hasOne(Payment::class);
    }
}
