<?php

namespace App\Filament\Resources\ReportContents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;

class ReportContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('reporter_id')
                    ->required()
                    ->numeric(),
                TextInput::make('reported_post_id')
                    ->required()
                    ->numeric(),
                Textarea::make('reasons')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('additional_info')
                    ->default(null)
                    ->columnSpanFull(),
                 Toggle::make('is_hidden')
                    ->required()
                    ->default(false),
            ]);
    }
}
