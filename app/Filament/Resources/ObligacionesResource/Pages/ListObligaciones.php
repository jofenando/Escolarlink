<?php

namespace App\Filament\Resources\ObligacionesResource\Pages;

use App\Filament\Resources\ObligacionesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObligaciones extends ListRecords
{
    protected static string $resource = ObligacionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
