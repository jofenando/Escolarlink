<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Obligaciones;
use App\Models\Matriculas;
use Livewire\Attributes\Title;

class ObligacionesEstadoOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [            
            Card::make('Pendiente', Obligaciones::query()->where('estado', 'pendiente')->count()),
            Card::make('Pagado', Obligaciones::query()->where('estado', 'pagado')->count()),
            Card::make('Matriculas', Matriculas::query()->where('estado_matricula', 'Activo')->count()),
        ];
    }
}
