<?php

namespace App\Filament\Resources\ApartPhotoResource\Pages;

use App\Filament\Resources\ApartPhotoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApartPhotos extends ListRecords
{
    protected static string $resource = ApartPhotoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
