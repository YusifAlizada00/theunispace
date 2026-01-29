<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;


class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->autocomplete('new-password') 
                    ->dehydrated(fn ($state) => filled($state)) 
                    ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),
                Toggle::make('is_admin')
                    ->label('Admin')
                    ->required(),
                Textarea::make('two_factor_secret')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('two_factor_recovery_codes')
                    ->default(null)
                    ->columnSpanFull(),
                DateTimePicker::make('two_factor_confirmed_at'),
                DateTimePicker::make('comment_banned_until'),
                TextInput::make('current_team_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('profile_photo_path')
                    ->default(null),
            ]);
    }
}
