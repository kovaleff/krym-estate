<?php

namespace App\Filament\Resources\ApartResource\Pages;

use App\Filament\Resources\ApartResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAparts extends ListRecords
{
    protected static string $resource = ApartResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
