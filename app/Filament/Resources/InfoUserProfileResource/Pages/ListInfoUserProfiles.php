<?php

namespace App\Filament\Resources\InfoUserProfileResource\Pages;

use App\Filament\Resources\InfoUserProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfoUserProfiles extends ListRecords
{
    protected static string $resource = InfoUserProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
