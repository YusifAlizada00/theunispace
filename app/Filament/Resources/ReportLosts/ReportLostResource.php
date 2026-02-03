<?php

namespace App\Filament\Resources\ReportLosts;

use App\Filament\Resources\ReportLosts\Pages\CreateReportLost;
use App\Filament\Resources\ReportLosts\Pages\EditReportLost;
use App\Filament\Resources\ReportLosts\Pages\ListReportLosts;
use App\Filament\Resources\ReportLosts\Pages\ViewReportLost;
use App\Filament\Resources\ReportLosts\Schemas\ReportLostForm;
use App\Filament\Resources\ReportLosts\Schemas\ReportLostInfolist;
use App\Filament\Resources\ReportLosts\Tables\ReportLostsTable;
use App\Models\ReportLost;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReportLostResource extends Resource
{
    protected static ?string $model = ReportLost::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?int $navigationSort = 4;
    public static function form(Schema $schema): Schema
    {
        return ReportLostForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReportLostInfolist::configure($schema);
    }

    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function table(Table $table): Table
    {
        return ReportLostsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReportLosts::route('/'),
            'create' => CreateReportLost::route('/create'),
            'view' => ViewReportLost::route('/{record}'),
            'edit' => EditReportLost::route('/{record}/edit'),
        ];
    }
}
