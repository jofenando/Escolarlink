<?php

namespace App\Filament\Resources\CalificacionesResource\Pages;

use App\Filament\Resources\CalificacionesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCalificaciones extends ListRecords
{
    protected static string $resource = CalificacionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
