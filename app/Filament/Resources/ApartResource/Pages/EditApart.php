<?php

namespace App\Filament\Resources\ApartResource\Pages;

use App\Filament\Resources\ApartResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApart extends EditRecord
{
    protected static string $resource = ApartResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
