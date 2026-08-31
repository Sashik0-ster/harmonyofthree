<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Ім\'я')
                    ->required(),
                TextInput::make('telegram_username')
                    ->label('Ник в телеграм')
                    ->default(null),
                TextInput::make('email')
                    ->label('Адреса Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('avatar_path')
                    ->label('аватарка')
                    ->default(null),
                TextInput::make('password')
                    ->label('Пароль')
                    ->password()
                    ->dehydrateStateUsing(fn(?string $state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn(?string $state) => filled($state))
                    ->required(fn(string $operation): bool => $operation === 'create'),
                DateTimePicker::make('created_at')
                    ->label('Дата створення')
                    ->default(now()),
                Select::make('roles')
                    ->label('Роль')
                    ->relationship('roles', 'name')
                    ->options(Role::pluck('name', 'id'))
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }
}
