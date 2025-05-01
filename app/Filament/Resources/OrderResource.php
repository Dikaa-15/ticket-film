<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    protected static ?string $navigationGroup = 'Films';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_number')
                    ->label('Nomor Order')
                    ->required()
                    ->readOnly()
                    ->default(fn() => \App\Models\Order::generateOrderCode())
                    ->maxLength(50),

                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Repeater::make('orderdetail')
                    ->label('Kursi')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('seat_id')
                            ->label('Pilih Kursi')
                            ->relationship('seat', 'seat_number')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Toggle::make('is_available')
                            ->label('Kursi Tersedia?')
                            ->default(true)
                            ->required(),
                    ])
                    ->minItems(1)
                    ->columnSpanFull(),


                Forms\Components\Select::make('showtime_id')
                    ->label('Showtime')
                    ->relationship(
                        name: 'showtime',
                        titleAttribute: 'id', // ini bisa diabaikan karena kita override di bawah
                        modifyQueryUsing: fn($query) => $query->with(['film', 'studio']) // load relasi film & studio
                    )
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return $record->film->title . ' - ' . $record->studio->name . ' - ' . $record->show_time;
                    })
                    ->searchable()
                    ->preload()
                    ->required(),


                Forms\Components\TextInput::make('quantity')
                    ->label('Jumlah Tiket')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required()
                    ->reactive() // WAJIB biar trigger perubahan
                    ->afterStateUpdated(function ($set, $get, $state) {
                        $jumlahTiket = max(1, intval($state)); // default minimal 1
                        $existing = $get('orderdetail') ?? [];

                        // Isi ulang Repeater agar sesuai jumlah tiket
                        $kursi = [];

                        for ($i = 0; $i < $jumlahTiket; $i++) {
                            $kursi[] = $existing[$i] ?? [ // ambil data sebelumnya kalau ada
                                'seat_id' => null,
                                'is_available' => true,
                            ];
                        }

                        $set('orderdetail', $kursi);
                    }),

                Forms\Components\TextInput::make('total_price')
                    ->label('Total Harga')
                    ->numeric()
                    ->prefix('IDR')
                    ->minValue(0)
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Paid',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),

                Forms\Components\Select::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'e-wallet' => 'e-wallet',
                        'bca' => 'bca',
                        'manual' => 'manual',
                    ])
                    ->required(),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Nomor Order')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('showtime_info')
                    ->label('Jadwal Tayang')
                    ->getStateUsing(function ($record) {
                        $showtime = $record->showtime;
                        if (!$showtime) return '-';

                        // Format tanggal dan waktu pakai Carbon (optional)
                        $date = Carbon::parse($showtime->show_date)->format('d M Y');
                        $time = Carbon::parse($showtime->show_time)->format('H:i');

                        return "{$date} - {$time}";
                    })
                    ->sortable(),


                Tables\Columns\TextColumn::make('quantity')
                    ->label('Jumlah Tiket')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'cancelled',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Pembayaran')
                    ->sortable()
                    ->toggleable(),

                // Tables\Columns\TextColumn::make('created_at')
                //     ->label('Dibuat')
                //     ->dateTime()
                //     ->since()
                //     ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'cancelled' => 'Cancelled',
                    ]),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                ViewAction::make(),
                Tables\Actions\Action::make('Approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->action(fn($record) => $record->update(['status' => 'confirmed']))
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
            // RelationManagers\OrderdetailRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
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
