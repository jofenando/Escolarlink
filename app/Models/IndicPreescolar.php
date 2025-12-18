<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndicPreescolar extends Model
{
    use HasFactory;
    public function asigPreescolar(): BelongsTo 
    {
        return $this->belongsTo(AsigPreescolar::class);
    }
}
