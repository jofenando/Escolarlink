<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatriculasResource\Pages;
use App\Filament\Resources\MatriculasResource\RelationManagers;
use Filament\Forms\Components\Section;
use App\Models\Matriculas;
use Doctrine\DBAL\Query;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class MatriculasResource extends Resource
{
    protected static ?string $model = Matriculas::class;

    protected static ?string $navigationGroup = 'GESTIÓN MATRÍCULAS';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información escolar:')
                ->schema([
                    Forms\Components\Select::make('estado_matricula')->label('Estado')->options([
                        'Prematricula' => 'Prematricula',
                        'Activo' => 'Activo',
                        'Inactivo' => 'Inactivo',
                    ]),
                    Forms\Components\TextInput::make('año_escolar')->maxLength(50),
                    Forms\Components\DatePicker::make('fecha_matricula')->date(),
                    /* Forms\Components\Select::make('grado_id')
                    ->relationship('Grado','grado')
                    ->preload()                
                    ->required(), */
                   /* Forms\Components\Select::make('grado_id')
                    ->relationship('grado','grado')
                    ->searchable() 
                    ->preload(),*/
                    Forms\Components\Select::make('grado')->options([
                        'Parvulos' => 'Parvulos',
                        'Prejardin' => 'Prejardin',
                        'Jardin' => 'Jardin',
                        'Transición' => 'Transición',
                        'Primero' => 'Primero',
                        'Segundo' => 'Segundo',
                        'Tercero' => 'Tercero',
                        'Cuarto' => 'Cuarto',
                        'Quinto' => 'Quinto',
                    ]),
                    Forms\Components\Select::make('jornada')->options([
                        'Mañana' => 'Mañana',
                        'Tarde' => 'Tarde',
                        'Completa' => 'Completa',                    
                    ]),
                ])->columns(5)->collapsible(),
                    Section::make('Información del estudiante:')
                    ->schema([
                        Forms\Components\TextInput::make('nombre_estudiante')->maxLength(190),
                        FileUpload::make('foto_estudiante')
                            ->label(__('Foto'))
                            ->avatar()                 
                            ->imageEditor()
                            ->disk('local')
                            ->directory('fotos_estudiantes')
                            ->visibility('private'),
                        Forms\Components\TextInput::make('lugar_nacimiento')->maxLength(190),
                        Forms\Components\DatePicker::make('fecha_nacimiento')->date(),
                        Forms\Components\TextInput::make('documento_estudiante')->maxLength(190),
                        Forms\Components\TextInput::make('lugar_documento')->maxLength(190),
                            ])->columns(2)->collapsible(),
                    Section::make('Información del padre:')
                    ->schema([
                        Forms\Components\TextInput::make('nombre_padre')->label('Nombre padre')->maxLength(190),
                        Forms\Components\TextInput::make('documento_padre')->label('Documento')->maxLength(190),
                        Forms\Components\TextInput::make('profesion_padre')->label('Profesión')->maxLength(190),
                        Forms\Components\TextInput::make('ocupacion_padre')->label('Ocupación')->maxLength(190),
                        Forms\Components\TextInput::make('tel_fijo_padre')->label('Telefono fijo')->maxLength(190)->tel(),
                        Forms\Components\TextInput::make('tel_cel_padre')->label('Telefono celular')->maxLength(190)->tel(),
                        Forms\Components\TextInput::make('email_padre')->label('Email')->maxLength(190)->email(),
                    ])->columns(3)->collapsible(),
                    Section::make('Información de la madre:')
                    ->schema([
                        Forms\Components\TextInput::make('nombre_madre')->label('Nombre madre')->maxLength(190),
                        Forms\Components\TextInput::make('documento_madre')->label('Documento')->maxLength(190),
                        Forms\Components\TextInput::make('profesion_madre')->label('Profesión')->maxLength(190),
                        Forms\Components\TextInput::make('ocupacion_madre')->label('Ocupación')->maxLength(190),
                        Forms\Components\TextInput::make('tel_fijo_madre')->label('Telefono fijo')->maxLength(190)->tel(),
                        Forms\Components\TextInput::make('tel_cel_madre')->label('Telefono celular')->maxLength(190)->tel(),
                        Forms\Components\TextInput::make('email_madre')->label('Email')->maxLength(190),
                    ])->columns(3)->collapsible(),
                    Section::make('Personas autorizadas para recoger el niño(a):')
                    ->schema([
                        Forms\Components\TextInput::make('autorizado_recoger1')->label('Nombre persona 1')->maxLength(190),
                        Forms\Components\TextInput::make('parentesco_recoger1')->label('Parentesco')->maxLength(190),
                        Forms\Components\TextInput::make('autorizado_recoger2')->label('Nombre persona 2')->maxLength(190),
                        Forms\Components\TextInput::make('parentesco_recoger2')->label('Parentesco')->maxLength(190),                       
                    ])->columns(2)->collapsible(),
                    Section::make('Archivos adjuntos:')                        
                        ->schema([                            
                            FileUpload::make('formato_matricula')
                            ->disk('local')
                            ->directory('adjuntos_estudiantes')
                            ->visibility('private')
                            ->maxSize(1024)
                            ->acceptedFileTypes(['application/pdf'])
                            ->enableOpen()
                            ->enableDownload()
                            ->removeUploadedFileButtonPosition('right'),
                            FileUpload::make('registro_civil')->disk('local')->directory('adjuntos_estudiantes')->visibility('private')->maxSize(1024)->enableOpen()->enableDownload(),
                            FileUpload::make('carnet_vacunas')->disk('local')->directory('adjuntos_estudiantes')->visibility('private')->maxSize(1024)->enableOpen()->enableDownload(),
                            FileUpload::make('afiliacion_eps')->disk('local')->directory('adjuntos_estudiantes')->visibility('private')->maxSize(1024)->enableOpen()->enableDownload(),
                            FileUpload::make('notas_anteriores')->disk('local')->directory('adjuntos_estudiantes')->visibility('private')->maxSize(1024)->enableOpen()->enableDownload(),
                        ])->columns(2)->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto_estudiante')
                    ->label('')
                    ->disk('local')
                    ->visibility('private')
                    ->circular()
                    ->defaultImageUrl(url('/avatars/placeholder.jpg')),
                Tables\Columns\TextColumn::make('nombre_estudiante')->searchable(),
                
                Tables\Columns\TextColumn::make('estado_matricula')->label('Estado')
                ->badge()->color(fn (string $state): string => match ($state) {  
                    'Prematricula' => 'warning',                  
                    'Activo' => 'success',
                    'Inactivo' => 'danger',
                }),

                Tables\Columns\TextColumn::make('grado')->searchable(),

                Tables\Columns\TextColumn::make('jornada')->searchable(),

                Tables\Columns\TextColumn::make('año_escolar')->label('Año Escolar'),
            ])
            ->filters([                
                Tables\Filters\SelectFilter::make('estado_matricula')->label('Estado')->options([
                    'Prematricula' => 'Prematricula',
                    'Activo' => 'Activo',
                    'Inactivo' => 'Inactivo',
                ]), 
                
                Tables\Filters\SelectFilter::make('grado')->label('Grado')->options([
                    'Parvulos' => 'Parvulos',
                    'Prejardin' => 'Prejardin',
                    'Jardin' => 'Jardin',
                    'Transición' => 'Transición',
                    'Primero' => 'Primero',
                    'Segundo' => 'Segundo',
                    'Tercero' => 'Tercero',
                    'Cuarto' => 'Cuarto',
                    'Quinto' => 'Quinto',
                ]), 

                Tables\Filters\SelectFilter::make('jornada')->label('Jornada')->options([
                    'Mañana' => 'Mañana',
                    'Tarde' => 'Tarde',
                    'Completa' => 'Completa',
                ]),   
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(),
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
            'index' => Pages\ListMatriculas::route('/'),
            'create' => Pages\CreateMatriculas::route('/create'),
            'edit' => Pages\EditMatriculas::route('/{record}/edit'),
        ];
    }
}
