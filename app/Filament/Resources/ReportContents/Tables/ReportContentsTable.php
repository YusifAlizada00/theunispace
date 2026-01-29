<?php

namespace App\Filament\Resources\ReportContents\Tables;

use BladeUI\Icons\Components\Icon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReportContentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reporter_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('reported_post_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('reasons')
                    ->sortable(),
                TextColumn::make('additional_info')
                    ->sortable(),
                 IconColumn::make('is_hidden')
                    ->boolean()
                    ->default(false),
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
