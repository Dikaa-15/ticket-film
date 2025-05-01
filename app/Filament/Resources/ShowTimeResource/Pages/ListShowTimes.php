<?php

namespace App\Filament\Resources\ShowTimeResource\Pages;

use App\Filament\Resources\ShowTimeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShowTimes extends ListRecords
{
    protected static string $resource = ShowTimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
