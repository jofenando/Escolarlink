<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asignatura extends Model
{
    public function indicador(): HasMany
    {
        return $this->hasMany(Indicador::class);
    }

    public function calificacionPeriodo(): belongsTo
    {
        return $this->belongsTo(CalificacionPeriodo::class);
    }

   
}
