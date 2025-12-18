<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CalificacionFinal extends Model
{
    use HasFactory;

    public function calificacion(): BelongsTo
    {
        return $this->belongsTo(Calificacion::class);
    }

    public function calificacionPeriodo(): HasMany
    {
        return $this->hasMany(CalificacionPeriodo::class);
    }
}
