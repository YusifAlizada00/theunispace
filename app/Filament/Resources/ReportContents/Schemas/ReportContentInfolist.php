<?php

namespace App\Filament\Resources\ReportContents\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\IconEntry;

class ReportContentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('reporter_id')
                    ->numeric(),
                TextEntry::make('reported_post_id')
                    ->numeric(),
                TextEntry::make('reasons'),
                TextEntry::make('additional_info'),
                IconEntry::make('is_hidden')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
