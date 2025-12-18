<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocenteResource\Pages;
use App\Filament\Resources\DocenteResource\RelationManagers;
use App\Models\Docente;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Closure;

class DocenteResource extends Resource
{
    protected static ?string $model = Docente::class;

    protected static ?string $navigationLabel = 'Docentes';
    protected static ?string $Label = 'Docentes';
    protected static ?string $pluralLabel = 'Docentes';
    protected static ?string $modelLabel = 'Docente';
    protected static ?string $navigationGroup = 'GESTIÓN ACADÉMICA';
    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    
    public static function form(Form $form): Form
    {
        

        return $form
            ->schema([
                Forms\Components\FileUpload::make('avatar_url')
                    ->avatar()
                    ->imageEditor()
                    ->disk('local')
                    ->visibility('private')
                    ->directory('avatars'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user','name')                    
                    ->label('Docente')
                    ->unique()
                    ->searchable()
                    ->preload()             
                    ->required()
                    ->reactive()
                    ->loadingMessage('Cargado usuarios...')
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $set('nombre_docente', User::find($get('user_id'))->name); }),

                Forms\Components\TextInput::make('nombre_docente'),
                Forms\Components\Select::make('id')
                    ->relationship('grado','grado')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                Forms\Components\Textarea::make('informacion')
                    ->maxLength(191),
                /* Forms\Components\TextInput::make('telefono')
                    ->maxLength(191)
                    ->prefixIcon('heroicon-m-phone'), */
                /* Forms\Components\TextInput::make('correo')
                    ->maxLength(191)
                    ->prefixIcon('heroicon-o-paper-airplane'), */
                
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('user.avatar_url')
                ->label('')
                ->disk('local')
                ->visibility('private')            
                ->label('')
                ->circular(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nombre docente')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('correo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.estado')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {                                            
                        'Activo' => 'success',
                        'Inactivo' => 'danger',                        
                        }),
                Tables\Columns\TextColumn::make('grado')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocentes::route('/'),
            'create' => Pages\CreateDocente::route('/create'),
            'edit' => Pages\EditDocente::route('/{record}/edit'),
        ];
    }
}
