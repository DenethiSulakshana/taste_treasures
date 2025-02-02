<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FoodResource\Pages;
use App\Filament\Resources\FoodResource\RelationManagers;
use App\Models\Food;
use App\Filament\Exports\FoodExporter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Notifications\Notifiable;

class FoodResource extends Resource
{
    protected static ?string $model = Food::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->label('Food Name'),
            
            Forms\Components\Select::make('category')
                ->label('Category')
                ->options([
                    'Snacks' => 'Snacks',
                    'Main Meals' => 'Main Meals',
                    'Desserts' => 'Desserts',
                    'Beverages' => 'Beverages',
                ])
                ->required(),

            Forms\Components\Textarea::make('description')
                ->label('Description'),

            Forms\Components\TextInput::make('price')
                ->numeric()
                ->required()
                ->label('Price (Rs)'),

            Forms\Components\TextInput::make('stock_level')
                ->numeric()
                ->required()
                ->label('Stock Level'),

            Forms\Components\FileUpload::make('image_path')
                ->label('Image')
                ->directory('foods')
                ->required(),
               ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('stock_level'),
                Tables\Columns\ImageColumn::make('image_path')
                       ->label('Image')
                       ->size(50, 50)
                       ->url(fn ($record) => asset('storage/' . $record->image_path)),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                ExportAction::make()->exporter(FoodExporter::class),
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
            'index' => Pages\ListFood::route('/'),
            'create' => Pages\CreateFood::route('/create'),
            'edit' => Pages\EditFood::route('/{record}/edit'),
        ];
    }
}
