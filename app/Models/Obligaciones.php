<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Obligaciones extends Model
{
    use HasFactory;
    public function matriculas(): BelongsTo 
    {
        return $this->belongsTo(Matriculas::class);
    }
 
    public function pagos(): HasMany
    {
        return $this->hasMany(Pagos::class);
    }
}