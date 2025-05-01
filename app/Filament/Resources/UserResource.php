<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Others';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1),

                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true) // biar pas edit gak konflik

                    ->columnSpan(1),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->minLength(6)
                    ->maxLength(255)
                    ->dehydrated(fn($state): bool => filled($state))
                    ->required(fn(string $context): bool => $context === 'create')
                    ->columnSpanFull(),

                TextInput::make('phone')
                    ->label('No. Telepon')
                    ->required()
                    ->tel()
                    ->telRegex('/^([0-9\s\-\+\(\)]*)$/')
                    ->maxLength(20)
                    ->columnSpan(1),

                Forms\Components\Select::make('roles')
                    ->label('Role')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User',
                    ])
                    ->preload()
                    ->required()
                    ->searchable()
                    ->columnSpan(1),

                FileUpload::make('poto')
                    ->label('Foto Profil')
                    ->image()
                    ->disk('public')
                    ->directory('profile')
                    ->preserveFilenames()
                    ->maxSize(1024)
                    ->columnSpanFull()
                    ->nullable()
                    ->visibility('public'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('poto')
                    ->label('Foto Profil')
                    ->size(50)
                    ->circular()
                    ->default('https://ui-avatars.com/api/?name=User&background=random'),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
