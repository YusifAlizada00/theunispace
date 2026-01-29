<?php

namespace App\Filament\Resources\SupportRequests;

use App\Filament\Resources\SupportRequests\Pages\CreateSupportRequests;
use App\Filament\Resources\SupportRequests\Pages\EditSupportRequests;
use App\Filament\Resources\SupportRequests\Pages\ListSupportRequests;
use App\Filament\Resources\SupportRequests\Pages\ViewSupportRequests;
use App\Filament\Resources\SupportRequests\Schemas\SupportRequestsForm;
use App\Filament\Resources\SupportRequests\Schemas\SupportRequestsInfolist;
use App\Filament\Resources\SupportRequests\Tables\SupportRequestsTable;
use App\Models\SupportRequests;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SupportRequestsResource extends Resource
{
    protected static ?string $model = SupportRequests::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::QuestionMarkCircle;

    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return SupportRequestsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SupportRequestsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SupportRequestsTable::configure($table);
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
            'index' => ListSupportRequests::route('/'),
            'create' => CreateSupportRequests::route('/create'),
            'view' => ViewSupportRequests::route('/{record}'),
            'edit' => EditSupportRequests::route('/{record}/edit'),
        ];
    }
}
