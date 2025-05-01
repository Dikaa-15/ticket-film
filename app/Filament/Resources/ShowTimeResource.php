<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShowTimeResource\Pages;
use App\Filament\Resources\ShowTimeResource\RelationManagers;
use App\Models\ShowTime;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput\Mask;
// use 
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShowTimeResource extends Resource
{
    protected static ?string $model = ShowTime::class;

protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Films';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bioskop_id')
                    ->label('Bioskop')
                    ->relationship('studio.bioskop', 'name')
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('studio_id', null))
                    ->required(),

                Forms\Components\Select::make('studio_id')
                    ->label('Studio')
                    ->options(function (callable $get) {
                        $bioskopId = $get('bioskop_id');

                        if (!$bioskopId) return [];

                        return \App\Models\Studio::where('bioskop_id', $bioskopId)
                            ->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('film_id')
                    ->relationship('film', 'title')
                    ->required(),

                Forms\Components\DatePicker::make('show_date')->required(),
                Forms\Components\TimePicker::make('show_time')->required(),
                Forms\Components\TimePicker::make('end_time')->required(),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(10000000)
                    ->default(0)
                    ->prefix('IDR')
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('film.title')
                    ->label('Film Title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('studio.name')
                    ->label('Studio Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('show_date')
                    ->label('Show Date')
                    ->sortable()
                    ->searchable()
                    ->date(),
                Tables\Columns\TextColumn::make('show_time')
                    ->label('Show Time')
                    ->sortable()
                    ->searchable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('end_time')
                    ->label('End Time')
                    ->sortable()
                    ->searchable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->searchable()
                    ->money('idr', true)
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShowTimes::route('/'),
            'create' => Pages\CreateShowTime::route('/create'),
            'edit' => Pages\EditShowTime::route('/{record}/edit'),
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
