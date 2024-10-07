<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeAuthorResource\Pages;
use App\Filament\Resources\RecipeAuthorResource\RelationManagers;
use App\Models\RecipeAuthor;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecipeAuthorResource extends Resource
{
    protected static ?string $model = RecipeAuthor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('name')
            ->required()
            ->maxLength(255),

            FileUpload::make('photo')
            ->image()
            ->required(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),

                ImageColumn::make('photo')
                ->circular(),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRecipeAuthors::route('/'),
            'create' => Pages\CreateRecipeAuthor::route('/create'),
            'edit' => Pages\EditRecipeAuthor::route('/{record}/edit'),
        ];
    }
}
