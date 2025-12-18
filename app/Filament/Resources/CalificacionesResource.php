<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalificacionesResource\Pages;
use App\Filament\Resources\CalificacionesResource\RelationManagers;
use App\Models\Calificacion;
use App\Models\AsigPreescolar;
use App\Models\Docente;
use App\Models\AsigPrimaria;
use App\Models\CalificacionPeriodo;
use App\Models\Matriculas;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Illuminate\Foundation\Events\LocaleUpdated;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Filament\Forms\Get;
use Filament\Forms\Set;

class CalificacionesResource extends Resource
{
    protected static ?string $model = Calificacion::class; 

    protected static ?string $navigationLabel = 'Calificaciones';
    protected static ?string $Label = 'Calificaciones';
    protected static ?string $pluralLabel = 'Calificaciones';
    protected static ?string $modelLabel = 'Calificaciones';
    protected static ?string $navigationGroup = 'GESTIÓN ACADÉMICA';
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    
/*     Forms\Components\Select::make('matriculas_id')
    ->relationship('matriculas','nombre_estudiante')
    ->label('Estudiante')
    ->searchable()
    ->preload()                
    ->required(),
Forms\Components\Checkbox::make('reg_periodo1'), */

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }   

    public static function form(Form $form): Form
    {
        
     return $form
        ->schema([
                Fieldset::make('Datos del Estudiante')
                ->schema([
                    Forms\Components\Select::make('matriculas_id')->relationship('matriculas','nombre_estudiante')                    
                    ->label('Estudiante')
                    ->searchable()
                    ->preload()                
                    ->required(),                    
                    Forms\Components\Select::make('grado')->relationship('matriculas','grado')                                 
                    ->label('Grado')                    
                    ->disabled('true')
                    ->preload(),
                    Forms\Components\Select::make('docente_id')
                    ->relationship('docente','nombre_docente')                    
                    ->preload()                
                    ->required(),
                    /* Forms\Components\TextInput::make('docente'), */
                    /* Forms\Components\Checkbox::make('reg_periodo1'), */
                ])->columns(3),

                Tabs::make('Heading')
                  ->columnSpanFull()
                  ->label('Calificaciones')                    
                  ->tabs([
                    Tabs\Tab::make('Periodo 1')
                        ->icon('heroicon-s-document-check')
                        ->schema([
                            Forms\Components\Grid::make(1)->schema([  
                                TableRepeater::make('CalificacionPeriodo')
                                    ->relationship('CalificacionPeriodo')
                                    ->label('Asignatura / Promedio')
                                    ->schema([
                                        Forms\Components\Select::make('asignatura_id')                    
                                        ->relationship('AsigPreescolar', 'asignatura')                                        
                                        ->label('Asignatura'), 
                                        Forms\Components\TextInput::make('prom_periodo_1')->label('Promedio / Periodo 1'),
                                        Forms\Components\TextInput::make('prom_periodo_2')->label('Promedio / Periodo 2'),
                                        Forms\Components\TextInput::make('prom_periodo_3')->label('Promedio / Periodo 3'),
                                        Forms\Components\TextInput::make('prom_periodo_4')->label('Promedio / Periodo 4'),
                                        
                                    ])
                                    ->collapsible()
                                    /* ->defaultItems(3),   */                             
                                    ]),                                        

                                ]),
                    Tabs\Tab::make('Periodo 2')
                        ->icon('heroicon-s-document-check') 
                        ->schema([
                            Forms\Components\Grid::make(1)->schema([     
                                TableRepeater::make('CalificacionPeriodo')
                                    ->relationship('CalificacionPeriodo')    
                                    ->label('Asignatura / Promedio')                                                                              
                                    ->schema([
                                        Forms\Components\Select::make('asignatura_id')                    
                                        ->relationship('AsigPreescolar', 'asignatura')                                        
                                        ->label('Asignatura'), 
                                        Forms\Components\TextInput::make('prom_periodo_2'),
                                        
                                    ])
                                    ->collapsible()
                                    ->defaultItems(3),                              
                                    ]),
                                ]),
                    Tabs\Tab::make('Periodo 3')
                        ->icon('heroicon-s-document-check')
                        ->schema([
                            Forms\Components\Grid::make(1)->schema([  
                                TableRepeater::make('CalificacionPeriodo')
                                    ->relationship('CalificacionPeriodo')    
                                    ->label('Asignatura / Promedio')                                                                              
                                    ->schema([
                                        Forms\Components\Select::make('asignatura_id')                    
                                        ->relationship('AsigPreescolar', 'asignatura')                                        
                                        ->label('Asignatura'), 
                                        Forms\Components\TextInput::make('prom_periodo_3')->label('Promedio'),
                                        
                                    ])
                                    ->collapsible()
                                    /* ->defaultItems(3),   */                             
                                    ]),
                                ]),
                    Tabs\Tab::make('Periodo 4')
                        ->icon('heroicon-s-document-check')
                        ->schema([
                            Forms\Components\Grid::make(1)->schema([  
                                TableRepeater::make('CalificacionPeriodo')
                                    ->relationship('CalificacionPeriodo')
                                    ->label('Asignatura / Promedio')
                                    ->schema([
                                        Forms\Components\Select::make('asignatura')                    
                                        ->options(AsigPreescolar::all()->pluck('asignatura', 'id'))                                      
                                        ->label('Asignatura'), 
                                        Forms\Components\TextInput::make('prom_periodo_4')->label('Promedio'),
                                        
                                    ])
                                    ->collapsible()
                                    /* ->defaultItems(3),   */                             
                                    ]),
                                ]),



                    Tabs\Tab::make('Nota Final')
                        ->icon('heroicon-c-check-badge')                                                         
                        ->schema([
                            Forms\Components\Grid::make(1)->schema([     
                                TableRepeater::make('CalificacionPeriodo')                                
                                    ->relationship('CalificacionPeriodo')
                                    ->label('Asignatura / Nota Final')                                                
                                    ->schema([
                                        Forms\Components\TextInput::make('asignatura'),
                                        Forms\Components\TextInput::make('nota_final'),
                                        Forms\Components\Textarea::make('observaciones'),
                                        
                                    ])
                                    ->collapsible()
                                    ->defaultItems(3),                            
                                    ]),
                                ]),            
                            ])->contained(false),
                            
            ]);
            

    }

  
    public static function table(Table $table): Table
    {

        
        return $table
        
            ->columns([
                /* TextColumn::make('slug')->visibleFrom('md'), */
                
                    ImageColumn::make('matriculas.foto_estudiante')
                        ->label('')                        
                        ->disk('local')
                        ->visibility('private')
                        ->circular()
                        /* ->defaultImageUrl(url('/fotos_estudiantes/placeholder.jpg')) */,
                    TextColumn::make('matriculas.nombre_estudiante')->searchable()->label('Estudiante'),
                    TextColumn::make('matriculas.grado')->searchable()->label('Estudiante'),
                ] )     
                
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
            'index' => Pages\ListCalificaciones::route('/'),
            'create' => Pages\CreateCalificaciones::route('/create'),
            'edit' => Pages\EditCalificaciones::route('/{record}/edit'),
        ];
    }
}
