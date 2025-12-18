<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsigPrimariaResource\Pages;
use App\Filament\Resources\AsigPrimariaResource\RelationManagers;
use App\Models\AsigPrimaria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AsigPrimariaResource extends Resource
{
    protected static ?string $model = AsigPrimaria::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationLabel = 'Asignaturas Primaria';
    protected static ?string $Label = 'Asignatura Primaria';
    protected static ?string $pluralLabel = 'Asignaturas Primaria';
    protected static ?string $modelLabel = 'Asignaturas Primaria';
    protected static ?string $navigationGroup = 'GESTIÓN ACADÉMICA';
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('asignatura')->required()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('asignatura')->searchable()->label('Asignaturas'),
                Tables\Columns\TextColumn::make('indicador_count')
                ->badge()
                ->label(__('Indicadores'))
                ->counts('')
                ->colors(['success']),
                Tables\Columns\TextColumn::make('updated_at')->date()->label('Actualización'),
            ])
            ->filters([
                //
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
            RelationManagers\IndicPrimariaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAsigPrimarias::route('/'),
            'create' => Pages\CreateAsigPrimaria::route('/create'),
            'edit' => Pages\EditAsigPrimaria::route('/{record}/edit'),
        ];
    }
}
