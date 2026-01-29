<?php

namespace App\Filament\Resources\SupportRequests\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SupportRequestsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('type'),
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('page')
                    ->label('Page')
                    ->default(null),
                TextEntry::make('solution_steps')
                    ->label('Solution')
                    ->default(null),
                TextEntry::make('feature')
                    ->label('Feature')
                    ->default(null),
                TextEntry::make('suggestions')
                    ->label('Suggestions')
                    ->default(null),
                TextEntry::make('subject')
                    ->label('Subject')
                    ->default(null),
                TextEntry::make('message')
                    ->label('Message'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
