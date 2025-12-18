<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Indicador extends Model
{
    use HasFactory;
    public function asignatura(): BelongsToMany 
    {
        return $this->belongsToMany(Asignatura::class);
    }

   
}
