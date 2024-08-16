<?php

namespace App\Filament\Resources;

use App\Filament\Resources;
use App\Filament\UserResource\Pages;
use App\Models\Articles\Competition;
use App\Models\Something;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'users';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Somethings')
                    ->relationship('something')
                    ->mutateRelationshipDataBeforeSaveUsing(fn () => [])
                    ->dehydrated()
                    ->schema([
                        Placeholder::make('should_not_show')->content('something hidden')->hidden()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Resources\UserResource\Pages\ListUsers::route('/'),
            'create' => Resources\UserResource\Pages\CreateUser::route('/create'),
            'edit' => Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
