<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;


class UserResource extends Resource
{
    protected static ?string $navigationGroup = 'USUARIOS Y ROLES';
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $modelLabel = 'Usuario';
    protected static ?int $navigationSort = 4;
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static bool $shouldRegisterNavigation = true;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('avatar_url')
                    ->label('Foto')
                    ->avatar()
                    ->disk('local')
                    ->visibility('private')
                    ->imageEditor(),   
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Select::make('roles')                    
                    ->relationship('roles', 'name')
                    ->required()
                    ->multiple()
                    ->preload()
                    ->searchable(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191),
                Forms\Components\Select::make('cargo') 
                    ->required()                   
                    ->options([                        
                        'Docente' => 'Docente',
                        'Director' => 'Director',
                        'Propietario' => 'Propietario',
                            ]),
                Forms\Components\Select::make('estado')
                    ->required()
                    ->options([
                        'Activo' => 'Activo',
                        'Inactivo' => 'Inactivo',                    
                            ]),                             
                Forms\Components\TextInput::make('password')->maxLength(191)
                ->password()
                ->required()                
                ->revealable()
                ->autocomplete(false),
                                     
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('')
                    ->disk('local')
                    ->visibility('private')
                    ->circular()
                    ->defaultImageUrl(url('/avatars/placeholder.jpg')),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'docente' => 'warning',                    
                        'directivo' => 'success',
                        'admin' => 'danger',
                        'super_admin' => 'danger',                    
                        'panel_user' => 'warning',
                        }),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
/*                 Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(), */
                /* Tables\Columns\TextColumn::make('foto')
                    ->searchable(), */
                /* Tables\Columns\TextColumn::make('avatar')
                    ->searchable(), */
                Tables\Columns\TextColumn::make('cargo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {                                            
                        'Activo' => 'success',
                        'Inactivo' => 'danger',                        
                        }),               
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                /* Tables\Columns\TextColumn::make('avatar_url')
                    ->searchable(), */
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
