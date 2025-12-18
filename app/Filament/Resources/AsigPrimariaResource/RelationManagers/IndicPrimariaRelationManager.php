<?php

namespace App\Filament\Resources\AsigPrimariaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IndicPrimariaRelationManager extends RelationManager
{
    protected static string $relationship = 'IndicPrimaria';

    protected static ?string $Label = 'Indicador Primaria';
    protected static ?string $pluralLabel = 'Indicador Primaria';
    protected static ?string $title = 'INDICADORES:';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('indicador')
                    ->label('Indicardor:')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('indicador')
            ->columns([
                Tables\Columns\TextColumn::make('indicador')->label('[ Indicador ]'),
                Tables\Columns\TextColumn::make('updated_at')->date()->label('[ Actualización ]'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Crear Indicardor'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
