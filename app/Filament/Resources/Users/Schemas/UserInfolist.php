<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('slug'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('is_admin')
                    ->label('Admin'),
                TextEntry::make('email_verified_at')
                    ->dateTime(),
                TextEntry::make('two_factor_confirmed_at')
                    ->dateTime(),
                TextEntry::make('comment_banned_until')
                    ->dateTime(),
                TextEntry::make('current_team_id')
                    ->numeric(),
                TextEntry::make('profile_photo_path'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
