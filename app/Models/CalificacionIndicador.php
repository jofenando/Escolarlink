<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CalificacionIndicador extends Model
{
    public function calificacionPeriodo(): BelongsTo
    {
        return $this->belongsTo(CalificacionPeriodo::class);
        
    }

    public function calificacion(): BelongsTo
    {
        return $this->belongsTo(Calificacion::class);
    }


}
