<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Film;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use App\Filament\Resources\FilmResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FilmResource\RelationManagers;
use App\Filament\Resources\FilmResource\RelationManagers\GenresRelationManager;
use App\Filament\Resources\FilmResource\RelationManagers\RatingsRelationManager;
use App\Filament\Resources\FilmResource\RelationManagers\GenresnameRelationManager;

class FilmResource extends Resource
{
    protected static ?string $model = Film::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    protected static ?string $navigationGroup = 'Managements';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Film Info')
                        ->schema([
                            Grid::make(2) // ← Bikin grid 2 kolom
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->label('Title')
                                        ->debounce(500) // Biar gak langsung update tiap ketik
                                        ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state)))
                                        ->columnSpan(1), // Biar rapi di 1 kolom

                                    Forms\Components\TextInput::make('slug')
                                        ->required()
                                        ->readOnly()
                                        ->label('Slug')
                                        ->columnSpan(1),

                                    Select::make('genres')
                                        ->relationship('genres', 'name')
                                        ->multiple()
                                        ->preload()
                                        ->searchable()
                                        ->label('Genres')
                                        ->columnSpanFull(), // Biar lebarin satu baris
                                ]),
                        ]),

                    Step::make('Release Info')
                        ->schema([
                            Grid::make(2)->schema([
                                Forms\Components\TextInput::make('duration')
                                    ->required()
                                    ->label('Duration'),

                                Forms\Components\DatePicker::make('date_release')
                                    ->required()
                                    ->label('Date Release'),

                                Forms\Components\TextInput::make('director')
                                    ->required()
                                    ->label('Director')
                                    ->columnSpan(2),

                                Forms\Components\TextInput::make('trailer')
                                    ->required()
                                    ->label('Trailer')
                                    ->columnSpan(2),
                            ]),
                        ]),

                    Step::make('Media')
                        ->schema([
                            Grid::make(2)->schema([
                                Forms\Components\FileUpload::make('poster')
                                    ->required()
                                    ->label('Poster')
                                    ->image()
                                    ->preserveFilenames()
                                    ->directory('poster'),

                                Forms\Components\Textarea::make('synopsis')
                                    ->required()
                                    ->label('Synopsis')
                                    ->columnSpan(2),
                            ]),
                        ]),
                ])

                    ->columnSpan('full') // Use full width for wizard
                    ->columns(1) // Make surethe forms has a single column layout
                    ->skippable(1)
            ]);
        // ->submitActionL ->maxWidth('7xl');// Biar wizard-nya gede bro
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('genres.name')
                    ->label('Genre')
                    ->searchable()
                    ->sortable(),
                    TextColumn::make('average_rating')
                    ->label('Avg. Rating')
                    ->getStateUsing(fn ($record) => number_format($record->averageRating(), 1)),
                
                TextColumn::make('duration')
                    ->label('Duration')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date_release')
                    ->label('Date Release')
                    ->date()
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            // GenresRelationManager::class,
            RatingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFilms::route('/'),
            'create' => Pages\CreateFilm::route('/create'),
            'edit' => Pages\EditFilm::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
