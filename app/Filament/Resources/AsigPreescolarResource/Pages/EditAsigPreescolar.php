<?php

namespace App\Filament\Resources\AsigPreescolarResource\Pages;

use App\Filament\Resources\AsigPreescolarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsigPreescolar extends EditRecord
{
    protected static string $resource = AsigPreescolarResource::class;

    protected static ?string $title = 'Editar Asignatura Preescolar';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
