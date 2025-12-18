<?php

namespace App\Filament\Resources\InfoUserProfileResource\Pages;

use App\Filament\Resources\InfoUserProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfoUserProfile extends EditRecord
{
    protected static string $resource = InfoUserProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
