<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matriculas extends Model
{
    use HasFactory;

    public function obligaciones(): HasMany
    {
        return $this->hasMany(Obligaciones::class);
    }

    use HasFactory;
    public function calificaciones(): HasMany
    {
        return $this->hasMany(Calificacion::class);
    }

    
    public function grado(): BelongsTo
    {
        return $this->BelongsTo(Grado::class);
    }
}
