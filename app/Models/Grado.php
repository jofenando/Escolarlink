<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grado extends Model
{
    public function docente(): BelongsTo
    {
        return $this->belongsTo(Docente::class);
    }

    public function matriculas(): HasMany
    {
        return $this->hasMany(Matriculas::class);
    }
}
