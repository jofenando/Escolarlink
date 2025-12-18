<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Calificacion extends Model
{
    use HasFactory;
    public function matriculas(): BelongsTo 
    {
        return $this->belongsTo(Matriculas::class);
    }

  /*   public function calificacionFinal(): HasMany
    {
        return $this->hasMany(CalificacionFinal::class);
    } */

    public function calificacionPeriodo(): HasMany
    {
        return $this->HasMany(CalificacionPeriodo::class);
    }

    public function calificacionIndicador(): HasMany
    {
        return $this->HasMany(CalificacionIndicador::class);
    }

    public function docente(): HasMany
    {
        return $this->HasMany(Docente::class);

    }

    public function asignatura(): HasMany
    {
        return $this->hasMany(Asignatura::class);
    }
}
