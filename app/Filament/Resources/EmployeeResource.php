<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use App\Filament\Exports\EmployeeExporter;
use Filament\Notifications\Notification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Notifications\Notifiable;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('employee_id')
                ->label('Employee Id')
                ->unique(ignorable: fn ($record) => $record)
                ->required(),
            Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required(),
            Forms\Components\TextInput::make('phone')
                ->label('Phone')
                ->tel()
                ->required(),
            Forms\Components\TextInput::make('nic_no')
                ->label('NIC No')
                ->required(),
            Forms\Components\Select::make('type')
                ->label('Type')
                ->options([
                    'Part Time' => 'Part Time',
                    'Permanent' => 'Permanent',
                ])
                ->default('Permanent')
                ->required(),
            Forms\Components\TextInput::make('address')
                ->label('Address')
                ->maxLength(255)
                ->required(),
            Forms\Components\DatePicker::make('date')
                ->label('Join Date')
                ->maxDate(today())
                ->default(now())
                ->required(),
            Forms\Components\Toggle::make('is_available')
                ->label('Is Available')
                ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee_id')->label('Worker Id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('nic_no'),
                Tables\Columns\TextColumn::make('type')
                ->label('Type'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('date')
                      ->label('Joined Date')
                      ->dateTime('Y-m-d'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\BooleanColumn::make('is_available')
                      ->label('Availability')
                      ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Available')->label('Available')
                ->action(function ($record) {
                    $record->update(['is_available' => true]);
                    Notification::make()
                        ->success()
                        ->title('Worker is Available')
                        ->send();
                })
                ->requiresConfirmation()
                ->color('success')
                ->icon('heroicon-o-check'),
            Tables\Actions\Action::make('Unavailable')->label('Unavailable')
                ->action(function ($record) {
                    $record->update(['is_available' => false]);
                    Notification::make()
                        ->danger()
                        ->title('Worker is Unavailable')
                        ->send();
                    })
                    ->requiresConfirmation()
                    ->color('danger')
                    ->icon('heroicon-o-x-mark'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                ExportAction::make()->exporter(EmployeeExporter::class),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
