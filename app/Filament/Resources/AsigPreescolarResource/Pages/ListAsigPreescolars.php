<?php

namespace App\Filament\Resources\AsigPreescolarResource\Pages;

use App\Filament\Resources\AsigPreescolarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAsigPreescolars extends ListRecords
{
    protected static string $resource = AsigPreescolarResource::class;
    protected static ?string $Label = 'Asignatura Preescolar';
    protected static ?string $modelLabel = 'Asignaturas Preescolar';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
