<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CalificacionPeriodo extends Model
{
    public function calificacionFinal(): BelongsTo
    {
        return $this->belongsTo(CalificacionFinal::class);
    }

    public function calificacion(): BelongsTo
    {
        return $this->belongsTo(Calificacion::class);
    }

    public function calificacionIndicador(): HasMany
    {
        return $this->hasMany(CalificacionIndicador::class);
    }

    public function asigPreescolar(): HasMany
    {
        return $this->hasMany(AsigPreescolar::class);
    }

    public function asigPrimaria(): HasMany
    {
        return $this->hasMany(AsigPrimaria::class);
    }

    public function asignatura(): HasMany
    {
        return $this->hasMany(Asignatura::class);
    }

    public function indicador(): HasMany
    {
        return $this->hasMany(Indicador::class);
    }

}
