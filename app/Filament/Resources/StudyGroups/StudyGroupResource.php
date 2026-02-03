<?php

namespace App\Filament\Resources\StudyGroups;

use App\Filament\Resources\StudyGroups\Pages\CreateStudyGroup;
use App\Filament\Resources\StudyGroups\Pages\EditStudyGroup;
use App\Filament\Resources\StudyGroups\Pages\ListStudyGroups;
use App\Filament\Resources\StudyGroups\Pages\ViewStudyGroup;
use App\Filament\Resources\StudyGroups\Schemas\StudyGroupForm;
use App\Filament\Resources\StudyGroups\Schemas\StudyGroupInfolist;
use App\Filament\Resources\StudyGroups\Tables\StudyGroupsTable;
use App\Models\StudyGroup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StudyGroupResource extends Resource
{
    protected static ?string $model = StudyGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::RectangleGroup;

    protected static ?int $navigationSort = 5;
    public static function form(Schema $schema): Schema
    {
        return StudyGroupForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StudyGroupInfolist::configure($schema);
    }

    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function table(Table $table): Table
    {
        return StudyGroupsTable::configure($table);
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
            'index' => ListStudyGroups::route('/'),
            'create' => CreateStudyGroup::route('/create'),
            'view' => ViewStudyGroup::route('/{record}'),
            'edit' => EditStudyGroup::route('/{record}/edit'),
        ];
    }
}
