<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AsigPrimaria extends Model
{
    use HasFactory;
    
    public function indicPrimaria(): HasMany
    {
        return $this->hasMany(IndicPrimaria::class);
    }

    public function calificacionPeriodo(): belongsTo
    {
        return $this->belongsTo(CalificacionPeriodo::class);
    }
}
