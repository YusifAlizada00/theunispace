<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('parent_id')
                    ->numeric()
                    ->default(null),
                Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('commentable_type')
                    ->required(),
                TextInput::make('commentable_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
