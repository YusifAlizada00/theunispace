<?php

namespace App\Filament\Resources\SupportRequests\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SupportRequestsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Select::make('type')
                    ->options(['issue' => 'Issue', 'feedback' => 'Feedback', 'other' => 'Other'])
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Textarea::make('page')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('solution_steps')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('feature')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('suggestions')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('subject')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
