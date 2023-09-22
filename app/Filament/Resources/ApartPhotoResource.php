<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApartPhotoResource\Pages;
use App\Filament\Resources\ApartPhotoResource\RelationManagers;
use App\Models\ApartPhoto;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApartPhotoResource extends Resource
{
    protected static ?string $model = ApartPhoto::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('apart_id')
                    ->relationship('apart', 'title'),
                Forms\Components\Toggle::make('is_featured')
                    ->required(),
                Forms\Components\FileUpload::make('image')->image()->multiple(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('apart_id'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListApartPhotos::route('/'),
            'create' => Pages\CreateApartPhoto::route('/create'),
            'edit' => Pages\EditApartPhoto::route('/{record}/edit'),
        ];
    }
}
