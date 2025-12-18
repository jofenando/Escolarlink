<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\IndicPreescolar;
use Livewire\Attributes\Title;

class IndicPreescolarOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [            
            Card::make('Indicadores', IndicPreescolar::query()->where('indicador', '$value = *')->count()),
            
        ];
    }
}
