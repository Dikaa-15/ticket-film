<?php

namespace App\Filament\Resources\BioskopResource\Pages;

use App\Filament\Resources\BioskopResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBioskop extends EditRecord
{
    protected static string $resource = BioskopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
