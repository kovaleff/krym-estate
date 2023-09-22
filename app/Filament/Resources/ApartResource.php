<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApartResource\Pages;
use App\Filament\Resources\ApartResource\RelationManagers;
use App\Filament\Resources\ApartResource\RelationManagers\ImagesRelationManager;
use App\Models\Apart;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApartResource extends Resource
{
    protected static ?string $model = Apart::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(45),
                Forms\Components\TextInput::make('link'),
                Forms\Components\TextInput::make('city'),
                Forms\Components\TextInput::make('phone'),
                Forms\Components\TextInput::make('phone'),
                Forms\Components\TextInput::make('address'),
                Forms\Components\TextInput::make('content'),
                Forms\Components\Select::make('developer_id')
                    ->relationship('developer', 'title')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn ::make('developer.title'),
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
            ImagesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAparts::route('/'),
            'create' => Pages\CreateApart::route('/create'),
            'edit' => Pages\EditApart::route('/{record}/edit'),
        ];
    }
}
