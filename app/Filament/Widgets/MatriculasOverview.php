<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Matriculas;
use Livewire\Attributes\Title;

class MatriculasOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [            
             Card::make('Matriculas', Matriculas::query()->where('estado_matricula', 'Activo')->count()),
        ];
    }
}
