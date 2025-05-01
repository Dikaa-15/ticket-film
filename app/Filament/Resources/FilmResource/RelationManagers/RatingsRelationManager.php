<?php

namespace App\Filament\Resources\FilmResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RatingsRelationManager extends RelationManager
{
    protected static string $relationship = 'ratings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('film_id')
                    ->label('Film')
                    ->relationship('film', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Textarea::make('review')
                    ->label('Ulasan')
                    ->maxLength(255),
                    Forms\Components\TextInput::make('rating')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('review')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User'),
                Tables\Columns\TextColumn::make('film.title')
                    ->label('Film'),
                Tables\Columns\TextColumn::make('review')
                    ->label('Ulasan')
                    ->limit(50),
                Tables\Columns\TextColumn::make('rating'),
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
