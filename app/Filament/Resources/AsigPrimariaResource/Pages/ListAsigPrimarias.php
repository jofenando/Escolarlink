<?php

namespace App\Filament\Resources\AsigPrimariaResource\Pages;

use App\Filament\Resources\AsigPrimariaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAsigPrimarias extends ListRecords
{
    protected static string $resource = AsigPrimariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
