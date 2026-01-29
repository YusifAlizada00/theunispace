<?php

namespace App\Filament\Resources\ReportContents;

use App\Filament\Resources\ReportContents\Pages\CreateReportContent;
use App\Filament\Resources\ReportContents\Pages\EditReportContent;
use App\Filament\Resources\ReportContents\Pages\ListReportContents;
use App\Filament\Resources\ReportContents\Pages\ViewReportContent;
use App\Filament\Resources\ReportContents\Schemas\ReportContentForm;
use App\Filament\Resources\ReportContents\Schemas\ReportContentInfolist;
use App\Filament\Resources\ReportContents\Tables\ReportContentsTable;
use App\Models\ReportContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReportContentResource extends Resource
{
    protected static ?string $model = ReportContent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ExclamationTriangle;

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return ReportContentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReportContentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReportContentsTable::configure($table);
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
            'index' => ListReportContents::route('/'),
            'create' => CreateReportContent::route('/create'),
            'view' => ViewReportContent::route('/{record}'),
            'edit' => EditReportContent::route('/{record}/edit'),
        ];
    }
}
