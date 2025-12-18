<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsigPreescolarResource\Pages;
use App\Filament\Resources\AsigPreescolarResource\RelationManagers;
use App\Models\AsigPreescolar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\IndicPreescolar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AsigPreescolarResource extends Resource
{
    protected static ?string $model = AsigPreescolar::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationLabel = 'Asignaturas Preescolar';
    protected static ?string $Label = 'Asignatura Preescolar';
    protected static ?string $pluralLabel = 'Asignaturas Preescolar';

    protected static ?string $modelLabel = 'Asignaturas Preescolar';
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
            RelationManagers\IndicPreescolarRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAsigPreescolars::route('/'),
            'create' => Pages\CreateAsigPreescolar::route('/create'),
            'edit' => Pages\EditAsigPreescolar::route('/{record}/edit'),
        ];
    }
}
