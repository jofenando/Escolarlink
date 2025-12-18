<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Docente extends Model
{
    use HasFactory;
    
        /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre_docente',
        
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
    

    public function calificacion(): BelongsTo
    {
        return $this->belongsTo(Calificacion::class);
    }

    public function grado(): HasMany
    {
        return $this->hasMany(Grado::class);
    }
}
