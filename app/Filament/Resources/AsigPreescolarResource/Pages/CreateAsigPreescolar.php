<?php

namespace App\Filament\Resources\AsigPreescolarResource\Pages;

use App\Filament\Resources\AsigPreescolarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAsigPreescolar extends CreateRecord
{
    protected static string $resource = AsigPreescolarResource::class;

    protected static ?string $title = 'Crear Asignatura Preescolar';
}
