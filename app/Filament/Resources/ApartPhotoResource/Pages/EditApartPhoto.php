<?php

namespace App\Filament\Resources\ApartPhotoResource\Pages;

use App\Filament\Resources\ApartPhotoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApartPhoto extends EditRecord
{
    protected static string $resource = ApartPhotoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
