<?php

namespace App\Filament\Resources\MatriculasResource\Pages;

use App\Filament\Resources\MatriculasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Matriculas;
use App\Filament\Widgets\MatriculasOverview;


class ListMatriculas extends ListRecords
{
    protected static string $resource = MatriculasResource::class;


 

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

        protected function getHeaderWidgets(): array
    {
        return [            
            MatriculasOverview::class,
            
        ];
    }

}
