<?php

namespace App\Livewire;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;
use Filament\Forms\Components\FileUpload;
use App\Models\User;

class InfoUserProfile extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;
    protected static ?string $model = User::class;

    public ?array $data = [];

    protected static int $sort = 0;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
        
            ->schema([
                Section::make('Componente personalizado')
                    ->aside()
                    ->description('Descrición de componente personalizado')
                    ,
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
    }

    public function render(): View
    {
        return view('livewire.info-user-profile');
    }
}
