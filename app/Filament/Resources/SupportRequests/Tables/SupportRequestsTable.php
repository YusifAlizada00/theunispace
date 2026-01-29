<?php

namespace App\Filament\Resources\SupportRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SupportRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('page')
                    ->label('Page')
                    ->default(null),
                TextColumn::make('solution_steps')
                    ->label('Solution')
                    ->default(null),
                TextColumn::make('feature')
                    ->label('Feature')
                    ->default(null),
                TextColumn::make('suggestions')
                    ->label('Suggestions')
                    ->default(null),
                TextColumn::make('subject')
                    ->label('Subject')
                    ->default(null),
                TextColumn::make('message')
                    ->label('Message'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
