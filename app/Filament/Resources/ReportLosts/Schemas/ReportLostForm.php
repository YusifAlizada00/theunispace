<?php

namespace App\Filament\Resources\ReportLosts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ReportLostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('item_name')
                    ->required(),
                Textarea::make('detailed_description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->required(),
                DatePicker::make('date_lost')
                    ->required(),
                TimePicker::make('time_from_lost')
                    ->required(),
                TimePicker::make('time_to_lost')
                    ->required(),
                Textarea::make('location_lost')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('images_lost'),
                Toggle::make('found')
                    ->required(),
            ]);
    }
}
