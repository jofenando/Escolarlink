<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsignaturasResource\Pages;
use App\Filament\Resources\AsignaturasResource\RelationManagers;
use App\Models\Asignatura;
use App\Models\Indicador;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\HasManyColumn;
use Filament\Tables\Columns\Summarizers\Count;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Counts;

class AsignaturasResource extends Resource
{
    protected static ?string $model = Asignatura::class;

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
                Forms\Components\TextInput::make('asignatura'),
                Forms\Components\Select::make('categoria')
                    ->options([
                        'Preescolar' => 'Preescolar',
                        'Primaria' => 'Primaria',
                    ]),                                                      
            ]);
            
    }

    

    public static function table(Table $table): Table
    {
        return $table
        ->groups([
            Group::make('categoria')
                
                ->titlePrefixedWithLabel(false)
                ->collapsible(),
        ])
        /* ->groupingSettingsHidden() */
        ->groupingDirectionSettingHidden()
        ->actions([
            ActionGroup::make([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                ]),
                // ...
            ])
        

            ->columns([
                Tables\Columns\TextColumn::make('asignatura')
                    ->label('Asignatura')
                    ->searchable()
                    ->sortable()
                    ->listWithLineBreaks()
                    ->bulleted()
                    ,
                Tables\Columns\TextColumn::make('categoria')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('indicador_count')->counts('indicador')
                ->label('Indicadores')
                ->badge()
                ->color('warning'),

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
            RelationManagers\IndicadorRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAsignaturas::route('/'),
            'create' => Pages\CreateAsignaturas::route('/create'),
            'edit' => Pages\EditAsignaturas::route('/{record}/edit'),
        ];
    }
}
