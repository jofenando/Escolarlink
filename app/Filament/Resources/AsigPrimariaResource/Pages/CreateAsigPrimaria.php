<?php

namespace App\Filament\Resources\AsigPrimariaResource\Pages;

use App\Filament\Resources\AsigPrimariaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAsigPrimaria extends CreateRecord
{
    protected static string $resource = AsigPrimariaResource::class;

    protected static ?string $title = 'Crear Asignatura Primaria';
}
