<?php

namespace App\Filament\Resources\ReportLosts\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReportLostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('item_name'),
                TextEntry::make('detailed_description')
                    ->columnSpanFull(),
                TextEntry::make('slug'),
                TextEntry::make('date_lost')
                    ->date(),
                TextEntry::make('time_from_lost')
                    ->time(),
                TextEntry::make('time_to_lost')
                    ->time(),
                TextEntry::make('location_lost')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                IconEntry::make('found')
                    ->boolean(),
            ]);
    }
}
