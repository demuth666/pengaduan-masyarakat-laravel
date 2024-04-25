<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nik')
                    ->label('NIK')
                    ->required()
                    ->placeholder('Masukan NIK'),
                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->placeholder('Masukan Nama'),
                TextInput::make('email')
                    ->label('Email')
                    ->unique(table: User::class, ignoreRecord: true)
                    ->required()
                    ->email()
                    ->placeholder('Masukan Email'),
                TextInput::make('password')
                    ->label('Password')
                    ->required()
                    ->password()
                    ->revealable()
                    ->confirmed()
                    ->placeholder('Masukan Password'),
                TextInput::make('password_confirmation')
                    ->label('Konfirmasi Password')
                    ->required()
                    ->password()
                    ->placeholder('Konfirmasi Password'),
                TextInput::make('no_wa')
                    ->label('No. WA')
                    ->required()
                    ->numeric()
                    ->placeholder('Masukan No. WA'),
                Select::make('Role')
                    ->options([
                        'admin' => 'admin',
                        'user' => 'user',
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('role')
                    ->label('Role')
                    ->searchable(),
                TextColumn::make('no_wa')
                    ->label('No. WA')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }


    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()->where('name', auth()->user()->name);
    // }
}
