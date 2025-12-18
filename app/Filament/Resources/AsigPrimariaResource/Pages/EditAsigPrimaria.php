<?php

namespace App\Filament\Resources\AsigPrimariaResource\Pages;

use App\Filament\Resources\AsigPrimariaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsigPrimaria extends EditRecord
{
    protected static string $resource = AsigPrimariaResource::class;

    protected static ?string $title = 'Editar Asignatura Primaria';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
