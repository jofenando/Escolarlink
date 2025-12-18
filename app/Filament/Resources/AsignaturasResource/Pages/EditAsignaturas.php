<?php

namespace App\Filament\Resources\AsignaturasResource\Pages;

use App\Filament\Resources\AsignaturasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsignaturas extends EditRecord
{
    protected static string $resource = AsignaturasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
