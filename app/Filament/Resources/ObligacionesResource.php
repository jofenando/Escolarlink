<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObligacionesResource\Pages;
use App\Filament\Resources\ObligacionesResource\RelationManagers;
use App\Models\Obligaciones;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObligacionesResource extends Resource
{
    protected static ?string $model = Obligaciones::class;

    protected static ?string $navigationGroup = 'GESTIÓN RECAUDOS';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('matriculas_id')
                ->relationship('matriculas','nombre_estudiante')
                ->label('Estudiante')
                ->searchable()
                ->preload()                
                ->required()
                ->createOptionForm([
                    Forms\Components\TextInput::make('nombre_estudiante')
                    ->label('Estudiante')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('año_escolar')
                    ->label('Año Escolar')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\DatePicker::make('fecha_matricula')
                    ->label('Fecha Matricula')
                    ->date()
                    ->required()]),

                Forms\Components\Select::make('mes')
                ->prefixIcon('heroicon-o-calendar')
                ->options([
                    'Enero' => 'Enero',
                    'Febrero' => 'Febrero',
                    'Marzo' => 'Marzo',
                    'Abril' => 'Abril',
                    'Mayo' => 'Mayo',
                    'Junio' => 'Junio',
                    'Julio' => 'Julio',
                    'Agosto' => 'Agosto',
                    'Septiembre' => 'Septiembre',
                    'Octubre' => 'Octubre',
                    'Nomviembre' => 'Nomviembre',
                    'Diciembre' => 'Diciembre',
                ])->required(),
                Forms\Components\TextInput::make('matricula')->numeric()->prefix('$')->default('0'),
                Forms\Components\TextInput::make('pension')->numeric()->prefix('$')->default('0'),
                Forms\Components\TextInput::make('materiales')->numeric()->prefix('$')->default('0'),
                Forms\Components\TextInput::make('extraclases')->numeric()->prefix('$')->default('0'),
                Forms\Components\TextInput::make('uniforme')->numeric()->prefix('$')->default('0'),
                Forms\Components\TextInput::make('total_pagar')->label('Total a Pagar')->numeric()->prefix('$')->disabled('true'),
                Forms\Components\Textarea::make('Descripción'),
                Forms\Components\Select::make('estado')
                ->options([
                    'pendiente' => 'Pendiente',
                    'pagado' => 'Pagado',
                ])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matriculas.nombre_estudiante')->searchable()->label('Estudiante'),
                Tables\Columns\TextColumn::make('mes')->searchable(),
                Tables\Columns\TextColumn::make('estado')->badge()->color(fn (string $state): string => match ($state) {                    
                    'pagado' => 'success',
                    'pendiente' => 'danger',
                }),
                Tables\Columns\TextColumn::make('matricula')->numeric()->prefix('$'),
                Tables\Columns\TextColumn::make('pension')->numeric()->prefix('$'),
                Tables\Columns\TextColumn::make('materiales')->numeric()->prefix('$'),
                Tables\Columns\TextColumn::make('extraclases')->numeric()->prefix('$'),
                Tables\Columns\TextColumn::make('uniforme')->numeric()->prefix('$'),
                Tables\Columns\TextColumn::make('total_pagar')->numeric()->prefix('$'),
                Tables\Columns\TextColumn::make('Descripción'),              
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('matriculas_id')->relationship('matriculas','nombre_estudiante')->label('Estudiante'),
                Tables\Filters\SelectFilter::make('mes'),
                Tables\Filters\SelectFilter::make('estado'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PagosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObligaciones::route('/'),
            'create' => Pages\CreateObligaciones::route('/create'),
            'edit' => Pages\EditObligaciones::route('/{record}/edit'),
        ];
    }
}
