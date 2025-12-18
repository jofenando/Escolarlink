<?php

namespace App\Filament\Resources\CalificacionesResource\Pages;

use App\Filament\Resources\CalificacionesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalificaciones extends EditRecord
{
    protected static string $resource = CalificacionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
