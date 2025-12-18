<?php

namespace App\Filament\Resources\ObligacionesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PagosRelationManager extends RelationManager
{
    protected static string $relationship = 'Pagos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([                
                Forms\Components\DatePicker::make('fecha_pago')
                    ->label('Fecha Pago')
                    ->date(),    
                Forms\Components\TextInput::make('valor')->required()->numeric()->prefix('$')->maxValue(42949672.95),    
                Forms\Components\TextInput::make('recibo')->required()->numeric()->prefix('#'),
                Forms\Components\Textarea::make('descripcion')
                    ->required()
                    ->maxLength(255)
                    ->columns('full'),  
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('descripcion')
            ->columns([                
                Tables\Columns\TextColumn::make('fecha_pago'),
                Tables\Columns\TextColumn::make('valor')->numeric()->prefix('$'),
                Tables\Columns\TextColumn::make('recibo')->prefix('#'),
                Tables\Columns\TextColumn::make('descripcion'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
