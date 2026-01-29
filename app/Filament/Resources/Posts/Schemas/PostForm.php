<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('tags')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Toggle::make('active')
                    ->required(),
            ]);
    }
}
